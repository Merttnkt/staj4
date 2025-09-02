<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductCategoryController extends Controller
{
    public function show(ProductCategory $category, Request $request)
    {
        $request->validate([
            'price' => 'nullable|in:asc,desc',
            'color' => 'nullable|string',
        ]);

        $query = Product::with('category')
            ->where('product_category_id', $category->id)
            ->where('is_active', true);

        if ($request->filled('color')) {
            $query->whereJsonContains('colors', ['name' => $request->color]);
        }

        if ($request->filled('price')) {
            $query->orderBy('price', $request->price);
        } else {
            $query->latest();
        }

        $products = $query->paginate(12);

        return Inertia::render('Products/CategoryShow', [
            'category' => $category,
            'products' => $products,
            'categories' => ProductCategory::orderBy('name')->get(),
            'filters' => $request->only(['price', 'color']),
        ]);
    }
}
