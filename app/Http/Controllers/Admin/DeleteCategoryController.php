<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class DeleteCategoryController extends Controller
{
    public function deleteCategory($catId)
    {
        Category::findOrFail($catId)->delete();

        return redirect('/admin/categories-list')->with('success', 'Kategori berhasil dihapus!');
    }
}
