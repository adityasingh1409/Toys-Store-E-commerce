<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
class DashboardController extends Controller {
    public function index() {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalCustomers = User::where('role', 'customer')->count();
        $totalRevenue = Order::sum('total_price');
        $lowStock = Product::where('stock', '<', 5)->get();
        $recentOrders = Order::latest()->take(5)->get();
        return view('admin.dashboard', compact('totalProducts', 'totalOrders', 'totalCustomers', 'totalRevenue', 'lowStock', 'recentOrders'));
    }
}