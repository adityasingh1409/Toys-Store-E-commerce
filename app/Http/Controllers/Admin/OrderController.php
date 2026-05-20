<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
class OrderController extends Controller {
    public function index() { return view('admin.orders.index', ['orders' => Order::latest()->get()]); }
    public function update(Request $request, Order $order) {
        $order->update(['status' => $request->status]);
        return back()->with('success', 'Status updated');
    }
}