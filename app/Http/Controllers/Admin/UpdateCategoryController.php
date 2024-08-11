<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class UpdateCategoryController extends Controller
{
    public function index($catId)
    {
        $category = Category::findOrFail($catId);

        return view('dashboard.admin.category-edit', [
            'category' => $category,
            'pageTitle' => 'Edit Kategori',
            'title' => 'Edit Kategori ' . $category->category_name,
            'active' => 'categories-list'
        ]);
    }

    public function updateCategory(Request $request, $catId)
    {
        $category = Category::findOrFail($catId);

        $categoryUpdate = $request->validate([
            'category_name' => 'required'
        ]);

        $category->update($categoryUpdate);

        return redirect('/admin/categories-list')->with('success', 'Kategori berhasil diperbarui!');
    }
}
