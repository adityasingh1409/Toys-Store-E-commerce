<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::latest()->take(6)->get();
        $categories       = Category::withCount('products')->get();
        $totalProducts    = Product::count();

        return view('landing', compact('featuredProducts', 'categories', 'totalProducts'));
    }
}
