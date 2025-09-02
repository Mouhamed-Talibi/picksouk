<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHealthAndBeautyRequest;
use App\Models\Category;
use App\Models\HealthAndBeauty;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HealthAndBeautyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $health_beauty_products = Product::whereHas('health_beauty_Details')
            ->with([
                'health_beauty_Details',
                'images',
                'category',
            ])->paginate(6);
        return view('admin.health_beauty.index', compact('health_beauty_products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.health_beauty.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHealthAndBeautyRequest $request)
    {
        $validatedFields = $request->validated();

        DB::transaction( function() use($validatedFields, $request) {
            $product = Product::create([
                'name' => $validatedFields['name'],
                'slug' => Str::slug($validatedFields['name']),
                'description_title' => $validatedFields['description_title'],
                'description' => $validatedFields['description'],
                'price' => $validatedFields['price'],
                'old_price' => $validatedFields['old_price'],
                'stock' => $validatedFields['stock'],
                'category_id' => $validatedFields['category_id'],
            ]);

            // save product details
            HealthAndBeauty::create([
                'product_id' => $product->id,
                'brand' => $validatedFields['brand'],
                'skin_type' => $validatedFields['skin_type'],
                'gender' => $validatedFields['gender'],
                'has_fragrance' => $validatedFields['has_fragrance'],
            ]);

            // files uploads
            if($request->hasFile('images')) {
                foreach($request->file('images') as $image) {
                    $path = $image->store('uploads/products/health_beauty', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'path' => $path
                    ]);
                }
            }
        });

        return redirect()->route('admin.products')
            ->with('success', 'Product Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(HealthAndBeauty $healthAndBeauty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $product = Product::with(['health_beauty_Details', 'images'])
            ->findOrFail($id);
        $categories = Category::all();
        return view('admin.health_beauty.edit', compact(['product', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreHealthAndBeautyRequest $request, int $id)
    {
        try {
            // Find the product by its ID
            $product = Product::findOrFail($id);
            $validated = $request->validated();

            // Update shared product fields
            $product->update([
                'name' => $validated['name'],
                'slug' => Str::slug($validated['name']),
                'description' => $validated['description'],
                'description_title' => $validated['description_title'],
                'stock' => $validated['stock'],
                'price' => $validated['price'],
                'old_price' => $validated['old_price'],
                'category_id' => $validated['category_id'],
            ]);

            // Update health_beauty-specific fields
            $health_beauty_product = HealthAndBeauty::where('product_id', $product->id)->firstOrFail();

            $health_beauty_product->update([
                'brand' => $validated['brand'],
                'has_fragrance' => $validated['has_fragrance'],
                'skin_type' => $validated['skin_type'],
                'gender' => $validated['gender'],
            ]);

            return redirect()->route('admin.health_beauty.manage')
                ->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update product: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HealthAndBeauty $healthAndBeauty)
    {
        //
    }
}
