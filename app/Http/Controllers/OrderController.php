<?php
namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
class OrderController extends Controller {
    public function index() {
        $orders = Order::where('user_id', auth()->id())->get();
        return view('orders.index', compact('orders'));
    }
    public function store(Request $request) {
        $request->validate(['address' => 'required']);
        $carts = Cart::where('user_id', auth()->id())->get();
        if ($carts->isEmpty()) return back()->with('error', 'Cart is empty');
        $total = 0;
        foreach ($carts as $cart) { $total += $cart->product->price * $cart->quantity; }
        $order = Order::create(['user_id' => auth()->id(), 'total_price' => $total, 'address' => $request->address]);
        foreach ($carts as $cart) {
            OrderItem::create(['order_id' => $order->id, 'product_id' => $cart->product_id, 'quantity' => $cart->quantity, 'price' => $cart->product->price]);
            $cart->product->decrement('stock', $cart->quantity);
            $cart->delete();
        }
        return redirect()->route('orders.index')->with('success', 'Order placed successfully');
    }
}