<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CreateCategoryController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.add-category', [
            'pageTitle' => 'Tambah Kategori',
            'title' => 'Tambah Kategori ',
            'active' => 'add-category'
        ]);
    }

    public function createCategory(Request $request)
    {
        $categoryData = $request->validate([
            'category_name' => 'required'
        ]);

        Category::create($categoryData);

        return redirect('/admin/categories-list')->with('success', 'Kategori berhasil ditambahkan!');
    }
}
