<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCategoryRequest;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Display dashboard
     */
    public function dashboard() {
        // get total Users, Orders, Products
        $totalUsers = User::where('role', '!=','admin')->count();
        $totalOrders = Order::where('status', '=','processing')->count();
        $totalProducts = Product::count();

        // users, orders, products growth
        $usersGrowth = $ordersGrowth = $productsGrowth = 0;

        // users growth
        $thisWeekUsers = User::where('role', '!=', 'admin')
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->count();

        $lastWeekUsers = User::where('role', '!=', 'admin')
            ->whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])
            ->count();

        if($lastWeekUsers > 0) {
            $usersGrowth = (($thisWeekUsers - $lastWeekUsers) / $lastWeekUsers) * 100;
        }

        // Orders growth
        $thisWeekOrders = Order::where('status', '=', 'processing')
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->count();

        $lastWeekOrders = Order::where('status', '=','processing')
            ->whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])
            ->count();

        if ($lastWeekOrders > 0) {
            $ordersGrowth = (($thisWeekOrders - $lastWeekOrders) / $lastWeekOrders) * 100;
        }

        // products growth
        $thisWeekProducts = Product::where('deleted_at', '!=', null)
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->count();

        $lastWeekProducts = Product::where('deleted_at', '!=', null)
            ->whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])
            ->count();

        if($lastWeekProducts > 0 ) {
            $productsGrowth = (($thisWeekProducts - $lastWeekProducts) / $lastWeekProducts) * 100;
        }

        // last registered users
        $lastRegisteredUsers = User::where('role', '!=', 'admin')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $recentOrders = Order::where('status', '=', 'processing')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $revenueGrowth = 0;
        return view('admin.dashborad', compact(['totalUsers', 'usersGrowth', 'totalOrders', 'ordersGrowth', 'totalProducts', 'productsGrowth', 'lastRegisteredUsers', 'revenueGrowth', 'recentOrders']));
    }

    /**
     * Display add category form
     */
    public function addCategory() {
        return view('admin.add_category');
    }

    // orders list
    public function orders()
    {
        $orders = Order::with(['product.images'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('admin.orders.index', compact('orders'));
    }

    // update order status
    public function updateOrderStatus(string $id) {
        $order = Order::findOrFail($id);
        $order->status = 'delivered';
        Payment::create([
            'order_id' => $order->id,
            'client_name' => $order->client_name,
            'product_id' => $order->product_id,
            'order_price' => $order->total_price,
        ]);
        $order->save();
        return to_route('admin.orders.index')
            ->with('success', 'Order status updated to delivered.');
    }

    // delete cancelled orders
    public function deleteCancelledOrders()
    {
        try {
            $deletedCount = Order::where('status', 'cancelled')->delete();
            
            return redirect()
                ->route('admin.orders.index')
                ->with('success', "Successfully deleted $deletedCount cancelled orders.");
        } catch (\Exception $e) {
            return back()
                ->with('error', "Failed to delete cancelled orders: " . $e->getMessage());
        }
    }


    /**
     * store category
     */
    public function storeCategory(AddCategoryRequest $request)
    {
        try {
            $validatedInputs = $request->validated();

            // Handle image upload
            if ($request->hasFile('image')) {
                $validatedInputs['image'] = $request->file('image')->store(
                    'uploads/categories/' . date('Y'),
                    'public'
                );
            }

            // Create category
            Category::create([
                'name' => $validatedInputs['name'],
                'slug' => Str::slug($validatedInputs['name']),
                'description' => $validatedInputs['description'],
                'image' => $validatedInputs['image'] ?? null,
            ]);

            return to_route('admin.categories')
                ->with('success', 'Category Created Successfully');

        } catch (QueryException $e) {
            // Check if it's a duplicate entry error
            if ($e->errorInfo[1] == 1062) {
                return back()
                    ->withInput()
                    ->with('error', 'This category already exists. Please choose a different name.');
            }
            
            // For other database errors
            return back()
                ->withInput()
                ->with('error', 'An error occurred while saving the category.');
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
