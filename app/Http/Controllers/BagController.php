<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBagsRequest;
use App\Models\Bag;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Str;

class BagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bagsProducts = Product::whereHas('bagsDetails')
            ->with([
                'bagsDetails',
                'images',
                'category',
            ])->paginate(6);
        return view('admin.bags.index', compact('bagsProducts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.bags.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBagsRequest $request)
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
            Bag::create([
                'product_id' => $product->id,
                'brand' => $validatedFields['brand'],
                'size' => $validatedFields['size'],
                'external_material' => $validatedFields['external_material'],
                'weight' => $validatedFields['weight'],
            ]);

            // files uploads
            if($request->hasFile('images')) {
                foreach($request->file('images') as $image) {
                    $path = $image->store('uploads/products/bags', 'public');
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
    public function show(Bag $bag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $bag)
    {
        $bagProduct = Product::whereHas('bagsDetails')
            ->with([
                'bagsDetails',
                'images',
                'category',
            ])->where('id', $bag)->first();
        $categories = Category::all();
        return view('admin.bags.edit', compact('bagProduct', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreBagsRequest $request, string $id)
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

            // Update bags fields
            $bag = Bag::where('product_id', $product->id)->firstOrFail();

            $bag->update([
                'size' => $validated['size'],
                'brand' => $validated['brand'],
                'external_material' => $validated['external_material'],
                'weight' => $validated['weight'],
            ]);

            return redirect()->route('admin.bags.manage')
                ->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update product: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bag $bag)
    {
        //
    }
}
