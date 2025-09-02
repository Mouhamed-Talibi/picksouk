<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductCategory;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.products_categories');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.add_products', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddProductRequest $request)
    {
        $validatedData = $request->validated();
        $slug = Str::slug($validatedData['name']);

        // Check if product exists
        if (Product::where('slug', $slug)->orWhere('name', $validatedData['name'])->exists()) {
            return back()
                ->withInput()
                ->with('error', 'هذا المنتج موجود بالفعل');
        }

        // Use transaction to ensure data consistency
        return DB::transaction(function () use ($validatedData, $slug, $request) {
            // Create product
            $product = Product::create([
                'name' => $validatedData['name'],
                'slug' => $slug,
                'description' => $validatedData['description'],
                'price' => $validatedData['price'],
                'stock' => $validatedData['stock'],
                'category_id' => $validatedData['category'],
                'image' => null, // We'll set the primary image from the gallery
            ]);

            // Store and attach images
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('uploads/products/'.date('Y'), 'public');
                
                $product->images()->create([
                    'path' => $path,
                    'order' => $index,
                    'is_primary' => $index === 0, // First image is primary
                ]);
            }

            // Set the first image as the product's main image
            $product->update([
                'image' => $product->images()->where('is_primary', true)->first()->path
            ]);

            return to_route('admin.products')
                ->with('success', 'تم إضافة المنتج بنجاح');
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product = Product::with([
            'category',
            'parfumDetails',
            'electronicsDetails',
            'clothesDetails',
            'health_beauty_Details',
            'bagsDetails',
        ])->findOrFail($product->id);

        // get related products based on category id
        $categoryId = $product->category_id;
        $relatedProducts = Product::where('category_id', $categoryId)
            ->with('images')
            ->paginate(4);

        // return view
        return view('app.product', compact(['product', 'relatedProducts']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.edit_product', compact(['product', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validatedData = $request->validated();

        try {
            DB::beginTransaction();

            // Handle image upload if present
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($product->image && Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($product->image);
                }
                
                $validatedData['image'] = $request->file('image')
                    ->store('uploads/products/'.date('Y'), 'public');
            }

            // Update product
            $product->update([
                'name' => $validatedData['name'],
                'slug' => Str::slug($validatedData['name']),
                'description' => $validatedData['description'],
                'price' => $validatedData['price'],
                'old_price' => $validatedData['old_price'] ?? null,
                'stock' => $validatedData['stock'],
                'category_id' => $validatedData['category'],
                'image' => $validatedData['image'] ?? $product->image,
            ]);

            DB::commit();

            return to_route('admin.products')
                ->with('success', 'Product updated successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Product update failed: ' . $e->getMessage());
            
            return back()
                ->withInput()
                ->with('error', 'Failed to update product. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Product::findOrFail($product->id)->delete();
        return to_route('admin.products')
            ->with('success', 'Product deleted successfully');
    }

    /**
     * Retore the specified resource from storage.
     */
    public function restore($product)
    {
        $product = Product::withTrashed()->findOrFail($product);
        $product->restore();
        return to_route('admin.products')
            ->with('success', 'Product Restored successfully');
    }
}
