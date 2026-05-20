<?php
namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
class CartController extends Controller {
    public function index() {
        $carts = Cart::where('user_id', auth()->id())->with('product')->get();
        return view('cart', compact('carts'));
    }
    public function add(Request $request, Product $product) {
        $cart = Cart::where('user_id', auth()->id())->where('product_id', $product->id)->first();
        if ($cart) {
            $cart->quantity += $request->quantity ?? 1;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => $request->quantity ?? 1
            ]);
        }
        return redirect()->route('cart.index')->with('success', 'Added to cart');
    }
    public function update(Request $request, Cart $cart) {
        $cart->update(['quantity' => $request->quantity]);
        return back();
    }
    public function remove(Cart $cart) {
        $cart->delete();
        return back();
    }
}