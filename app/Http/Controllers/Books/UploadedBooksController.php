<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Book;

class UploadedBooksController extends Controller
{
    public function index()
    {
        $userId = Auth()->user()->user_id;
        $books = Book::where('user_id', $userId)->paginate(5);

        return view('dashboard.user.added-books', [
            'books' => $books,
            'pageTitle' => 'Buku yang Diunggah',
            'title' => 'Buku yang Diunggah',
            'active' => 'uploaded-books',
        ]);
    }
}
