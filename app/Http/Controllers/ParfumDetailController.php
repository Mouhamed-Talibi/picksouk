<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParfumRequest;
use App\Models\Category;
use App\Models\ParfumDetail;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ParfumDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parfums = Product::whereHas('parfumDetails')
            ->with([
                'parfumDetails',
                'images',
                'category'
            ])->paginate(6);
        return view('admin.parfums.index', compact('parfums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.parfums.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreParfumRequest $request)
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

            // save parfum details
            ParfumDetail::create([
                'product_id' => $product->id,
                'mark' => $validatedFields['mark'],
                'volume' => $validatedFields['volume'],
                'gender' => $validatedFields['gender'],
            ]);

            // files uploads
            if($request->hasFile('images')) {
                foreach($request->file('images') as $image) {
                    $path = $image->store('uploads/products/parfums', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'path' => $path
                    ]);
                }
            }
        });

        return redirect()->route('admin.products')
            ->with('success', 'Parfum Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ParfumDetail $parfumDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ParfumDetail $parfum)
    {
        $parfum = Product::with(['parfumDetails', 'images'])
            ->findOrFail($parfum->id);
        $categories = Category::all();
        return view('admin.parfums.edit', compact(['parfum', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreParfumRequest $request, ParfumDetail $parfum)
    {
        DB::beginTransaction();

        try {
            // Get the related product (now using ->product instead of ->products)
            $product = $parfum->product;    
            
            if (!$product) {
                throw new \Exception("Related product not found for this parfum detail.");
            }

            // Update the product
            $product->update([
                'name' => $request->validated('name'),
                'slug' => Str::slug($request->validated('name')),
                'description_title' => $request->validated('description_title'),
                'description' => $request->validated('description'),
                'price' => $request->validated('price'),
                'old_price' => $request->validated('old_price'),
                'stock' => $request->validated('stock'),
                'category_id' => $request->validated('category_id', $product->category_id),
            ]);

            // Update parfum details
            $parfum->update([
                'mark' => $request->validated('mark'),
                'volume' => $request->validated('volume'),
                'gender' => $request->validated('gender'),
            ]);

            // Handle image uploads if present
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('products', 'public');
                    $product->images()->create(['path' => $path]);
                }
            }

            DB::commit();

            return redirect()->route('admin.parfums.manage')
                ->with('success', 'Parfum updated successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Parfum update failed: ' . $e->getMessage());
            
            return back()->withInput()
                ->with('error', 'Failed to update parfum: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ParfumDetail $parfumDetail)
    {
        //
    }
}
