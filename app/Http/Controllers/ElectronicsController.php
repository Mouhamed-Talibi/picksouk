<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreElectronicsRequest;
use App\Models\Category;
use App\Models\Electronics;
use App\Models\Product;
use App\Models\ProductImage;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ElectronicsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $electronics = Product::whereHas('electronicsDetails')
            ->with([
                'electronicsDetails',
                'images',
                'category',
            ])->paginate(6);
        return view('admin.electronics.index', compact('electronics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.electronics.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreElectronicsRequest $request)
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
            Electronics::create([
                'product_id' => $product->id,
                'brand' => $validatedFields['brand'],
                'weight' => $validatedFields['weight'],
                'ram' => $validatedFields['ram'],
                'storage' => $validatedFields['rom'],
                'camera' => $validatedFields['camera'],
                'screen_size' => $validatedFields['screen_size'],
                'processor' => $validatedFields['processor'],
                'operating_system' => $validatedFields['operating_system'],
            ]);

            // files uploads
            if($request->hasFile('images')) {
                foreach($request->file('images') as $image) {
                    $path = $image->store('uploads/products/electronics', 'public');
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
    public function show(Electronics $electronics)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::with(['electronicsDetails', 'images'])
            ->findOrFail($id);
        $categories = Category::all();
        return view('admin.electronics.edit', compact(['product', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreElectronicsRequest $request, int $id)
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
        $electronics = Electronics::where('product_id', $product->id)->firstOrFail();

        $electronics->update([
            'ram' => $validated['ram'],
            'storage' => $validated['rom'],
            'screen_size' => $validated['screen_size'],
            'operating_system' => $validated['operating_system'],
            'brand' => $validated['brand'],
            'weight' => $validated['weight'],
            'camera' => $validated['camera'],
            'processor' => $validated['processor'],
        ]);

        return redirect()->route('admin.electronics.manage')
            ->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update product: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Electronics $electronics)
    {
        //
    }
}
