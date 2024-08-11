<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class ListCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('dashboard.admin.categories', [
            'categories' => $categories,
            'pageTitle' => 'Daftar Kategori',
            'title' => 'List Kategori',
            'active' => 'categories-list'
        ]);
    }
}
