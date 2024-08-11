<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\Category;

class CreateBookController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('dashboard.user.add-book', [
            'categories' => $categories,
            'pageTitle' => 'Tambah Buku',
            'active' => 'add-book',
        ]);
    }

    public function createBook(Request $request)
    {
        $booksData = $request->validate([
            'category_id' => ['required'],
            'book_title' => ['required'],
            'book_cover_path' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'book_description' => ['required'],
            'book_total' => ['required', 'numeric', 'min:0'],
            'book_path' => ['required', 'mimes:pdf', 'max:10000']
        ]);

        if ($request->file('book_cover_path')) {
            $booksData['book_cover_path'] = $request->file('book_cover_path')->store('book-covers', 'public');
        }

        if ($request->file('book_path')) {
            $booksData['book_path'] = $request->file('book_path')->store('book-pdfs', 'public');
        }

        $booksData['user_id'] = Auth()->user()->user_id;

        Book::create($booksData);

        return redirect('/uploaded-books')->with('success', 'Buku berhasil ditambahkan!');
    }
}
