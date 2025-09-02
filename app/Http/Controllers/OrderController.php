<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userOrders = Order::where('client_id', Auth::id())
            ->where('status', 'processing')
            ->get();
        return view('app.orders.index', compact('userOrders'));
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
    public function store(StoreOrderRequest $request)
    {
        $validated = $request->validated();

        // Retrieve product
        $product = Product::findOrFail($validated['product_id']);

        // get user orders
        $userOrders = Order::where('client_id', Auth::id())
            ->where('status', 'processing')
            ->count();
        // check the number of processing orders
        if($userOrders >= 3) {
            return back()
                ->with('warning', 'معذرة لايمكنك تجاوز 3 طلبات حتى تتوصل بطلباتك الحالية');
        } else {
            // Check stock
            if ($validated['quantity'] > $product->stock) {
                return back()->with('error', "معذرة الكمية التي طلبتها غير متوفرة حاليا");
            } else {
                Order::create([
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'client_id' => Auth::id(),
                    'client_name' => $validated['client_name'],
                    'client_address' => $validated['client_address'],
                    'city' => $validated['city'],
                    'quantity' => $validated['quantity'],
                    'client_phone' => $validated['client_phone'],
                    'total_price' => $product->price * $validated['quantity'],
                ]);

                // decrement quantity
                $product->decrement('stock', $validated['quantity']);

                return redirect()->route('app.my_orders')
                    ->with('success', 'لقد تم تأكيد طلبك بنجاح');
                }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        Order::where('id', $order->id)
            ->update([
                'status' => 'cancelled',
            ]);
        return back()->with('success', 'تم إلغاء الطلب بنجاح');
    }
}
