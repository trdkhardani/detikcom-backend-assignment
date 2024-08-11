<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;

class BookController extends Controller
{
    public function index()
    {
        $title = '';
        if(request('category'))
        {
            $category = Category::firstWhere('category_id', request('category'));
            $title = ' Kategori ' . $category->category_name;
        }

        if(request('user'))
        {
            $user = User::firstWhere('username', request('user'));
            $title = ' Diunggah oleh ' . $user->user_name;
        }

        $books = Book::latest()->filter(request(['category', 'user']))->paginate(5)->withQueryString();
        $categories = Category::all();

        return view('books.index', [
            'pageTitle' => 'Buku ',
            'title' => $title,
            'active' => 'books',
            'books' => $books,
            'categories' => $categories,
            // 'currentCategory' => request('category'),
        ]);
    }
}
