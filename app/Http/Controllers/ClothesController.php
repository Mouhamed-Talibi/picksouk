<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClothesRequest;
use App\Models\Category;
use App\Models\Clothes;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClothesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clothes = Product::whereHas('clothesDetails')
            ->with([
                'electronicsDetails',
                'images',
                'category',
            ])->paginate(9);
        return view('admin.clothes.index', compact('clothes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.clothes.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClothesRequest $request)
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
            Clothes::create([
                'product_id' => $product->id,
                'brand' => $validatedFields['brand'],
                'size' => $validatedFields['size'],
                'age_group' => $validatedFields['gender'],
                'age' => $validatedFields['age'],
            ]);

            // files uploads
            if($request->hasFile('images')) {
                foreach($request->file('images') as $image) {
                    $path = $image->store('uploads/products/clothes', 'public');
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
    public function show(Clothes $clothes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $product = Product::with(['clothesDetails', 'images', 'category'])
            ->findOrFail($id);
        $categories = Category::all();
        return view('admin.clothes.edit', compact(['product', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreClothesRequest $request, int $id)
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

            // Update electronics-specific fields
            $clothes = Clothes::where('product_id', $product->id)->firstOrFail();

            $clothes->update([
                'age_group' => $validated['gender'],
                'size' => $validated['size'],
                'age' => $validated['age'],
                'brand' => $validated['brand'],
            ]);

            return redirect()->route('admin.clothes.manage')
                ->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update product: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clothes $clothes)
    {
        //
    }
}
