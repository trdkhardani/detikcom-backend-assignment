<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Book;

class BookDetailController extends Controller
{
    public function index($bookId)
    {
        $book = Book::findOrFail($bookId);

        $userId = Auth()->user()->user_id;

        if($book->user->user_id !== $userId){
            abort(403);
        }

        return view('dashboard.user.book-detail', [
            'book' => $book,
            'pageTitle' => 'Detail Buku',
            'active' => 'uploaded-books',
            // 'title' => $book->book_title,
        ]);
    }
}
