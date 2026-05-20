<?php
namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller {
    public function index() { return view('admin.products.index', ['products' => Product::with('category')->get()]); }
    public function create() { return view('admin.products.create', ['categories' => Category::all()]); }
    public function store(Request $request) {
        $data = $request->validate(['name' => 'required', 'price' => 'required|numeric', 'stock' => 'required|integer', 'category_id' => 'required', 'description' => 'nullable', 'image' => 'nullable|image']);
        if ($request->hasFile('image')) $data['image'] = $request->file('image')->store('products', 'public');
        Product::create($data);
        return redirect()->route('admin.products.index');
    }
    public function edit(Product $product) { return view('admin.products.edit', ['product' => $product, 'categories' => Category::all()]); }
    public function update(Request $request, Product $product) {
        $data = $request->validate(['name' => 'required', 'price' => 'required|numeric', 'stock' => 'required|integer', 'category_id' => 'required', 'description' => 'nullable', 'image' => 'nullable|image']);
        if ($request->hasFile('image')) {
            if ($product->image) Storage::disk('public')->delete($product->image);
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        $product->update($data);
        return redirect()->route('admin.products.index');
    }
    public function destroy(Product $product) { if ($product->image) Storage::disk('public')->delete($product->image); $product->delete(); return back(); }
}