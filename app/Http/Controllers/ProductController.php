<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'price' => 'nullable|in:asc,desc',
            'color' => 'nullable|string',
            'category' => 'nullable|integer|exists:product_categories,id',
        ]);

        $query = Product::with('category')->where('is_active', true);

        if ($request->filled('category')) {
            $query->where('product_category_id', $request->category);
        }

        if ($request->filled('price')) {
            $query->orderBy('price', $request->price);
        } else {
            $query->latest();
        }

        $products = $query->paginate(12);

        $categories = ProductCategory::orderBy('name')->get();

        return Inertia::render('Products/Index', [
            'products' => $products,
            'categories' => $categories,
            'filters' => $request->only(['price', 'color', 'category']),
        ]);
    }

    public function show(Product $product)
    {
        if (!$product->is_active) {
            abort(404);
        }

        $product->load('category');

        $similarProducts = Product::with('category')
            ->where('product_category_id', $product->product_category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->limit(4)
            ->get();

        return Inertia::render('Products/Show', [
            'product' => $product,
            'similarProducts' => $similarProducts
        ]);
    }
}
