<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\AddCategoryRequest;
    use App\Http\Requests\UpdateCategoryRequest;
    use App\Models\Category;
    use App\Models\Product;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Storage;

    class CategoryController extends Controller
    {
        // categories index method
        public function index() {
            $categories = Category::paginate(6);
            $trashedCategories = Category::onlyTrashed()->paginate(6);
            return view('admin.categories', compact(['categories', 'trashedCategories']));
        }

        // edit category method
        public function edit($id) {
            $category = Category::findOrFail($id);
            return view('admin.edit_category', compact('category'));
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(UpdateCategoryRequest $request, Category $category)
        {
            DB::beginTransaction();

            try {
                $validatedData = $request->validated();

                // Handle image upload if present
                if ($request->hasFile('image')) {
                    // Delete old image if it exists
                    if ($category->image) {
                        Storage::disk('public')->delete($category->image);
                    }
                    
                    // Store new image with organized path
                    $validatedData['image'] = $request->file('image')->store(
                        'categories/' . now()->format('Y/m'), 
                        'public'
                    );
                } else {
                    // Keep the existing image if no new one uploaded
                    $validatedData['image'] = $category->image;
                }

                // Update the category
                $category->update([
                    'name' => $validatedData['name'],
                    'slug' => str_replace(" ", "-", $validatedData['name']),
                    'description' => $validatedData['description'],
                    'image' => $validatedData['image'],
                ]);

                DB::commit();

                return redirect()->route('admin.categories')
                    ->with('success', 'Category updated successfully');
            } catch (\Exception $e) {
                DB::rollBack();
                
                // Delete the newly uploaded image if the transaction failed
                if (isset($validatedData['image']) && $validatedData['image'] !== $category->image) {
                    Storage::disk('public')->delete($validatedData['image']);
                }

                return back()->withInput()
                    ->with('error', 'Failed to update category: ' . $e->getMessage());
            }
        }

        // delete category method
        public function destroy(Category $category)
        {
            try {
                DB::transaction(function () use ($category) {
                    // Delete the image if it exists
                    if ($category->image && Storage::exists($category->image)) {
                        Storage::delete($category->image);
                    }

                    $category->delete();
                });

                return redirect()->route('admin.categories')
                    ->with('success', 'Category deleted successfully');
            } catch (\Exception $e) {
                return back()->with('error', 'Failed to delete category: ' . $e->getMessage());
            }
        }

        // restore category method
        public function restore($id)
        {
            // Find the soft-deleted category (including trashed)
            $category = Category::withTrashed()->findOrFail($id);
            
            // Restore the category
            $category->restore();
            
            return redirect()->route('admin.categories')
                ->with('success', 'Category restored successfully');
        }

        // show method for products by category
        public function show(Category $category) {
            $products = $category->products()->paginate(8);
            return view('app.category_products', compact('category', 'products'));
        }

        // producsCategory
        public function productsCategory(Category $category) {
            $category = Category::findOrFail($category->id);
            $productsCategory = Product::with([
                'images',
                'parfumDetails',
                'electronicsDetails',
                'health_beauty_Details',
            ])->where('category_id', $category->id)
                ->paginate(9); 
            return view('productsCategory', compact(['productsCategory', 'category']));
        }

    }