<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ProductCategoryManagementController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::orderBy('name')->paginate(10);
        return Inertia::render('Admin/ProductCategories/Index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/ProductCategories/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:product_categories',
        ]);

        ProductCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.product-categories.index')->with('success', 'Kategori başarıyla oluşturuldu.');
    }

    public function edit(ProductCategory $productCategory)
    {
        return Inertia::render('Admin/ProductCategories/Edit', [
            'category' => $productCategory,
        ]);
    }

    public function update(Request $request, ProductCategory $productCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name,' . $productCategory->id,
        ]);

        $productCategory->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.product-categories.index')->with('success', 'Kategori başarıyla güncellendi.');
    }

    public function destroy(ProductCategory $productCategory)
    {
        if ($productCategory->products()->count() > 0) {
            return redirect()->route('admin.product-categories.index')->with('error', 'Bu kategori silinemez çünkü içinde ürünler var.');
        }

        $productCategory->delete();

        return redirect()->route('admin.product-categories.index')->with('success', 'Kategori başarıyla silindi.');
    }
}
