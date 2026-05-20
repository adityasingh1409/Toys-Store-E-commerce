<?php
namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
class HomeController extends Controller {
    public function index(Request $request) {
        $query = Product::query();
        if($request->has('search')) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }
        if($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }
        $products = $query->get();
        $categories = Category::all();
        return view('home', compact('products', 'categories'));
    }
    public function show(Product $product) {
        return view('product', compact('product'));
    }
}