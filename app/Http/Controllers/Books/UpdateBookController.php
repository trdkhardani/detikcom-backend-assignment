<?php

namespace App\Http\Controllers\Books;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class UpdateBookController extends Controller
{
    public function index($bookId)
    {
        $userId = Auth()->user()->user_id;
        $book = Book::findOrFail($bookId);
        $categories = Category::all();

        if ($book->user->user_id !== $userId && Auth()->user()->user_role !== 'admin') {
            abort(403);
        }

        return view('dashboard.user.edit-book', [
            'book' => $book,
            'categories' => $categories,
            'pageTitle' => 'Edit Buku',
            'active' => 'uploaded-books'
        ]);
    }

    public function updateBook(Request $request, $bookId)
    {
        $userId = Auth()->user()->user_id;
        $book = Book::findOrFail($bookId);

        if ($book->user->user_id !== $userId && Auth()->user()->user_role !== 'admin') {
            abort(403);
        }

        $updatedBookData = $request->validate([
            'category_id' => ['required'],
            'book_title' => ['required'],
            'book_cover_path' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'book_description' => ['required'],
            'book_total' => ['required', 'numeric', 'min:0'],
            'book_path' => ['mimes:pdf', 'max:10000']
        ]);

        if ($request->file('book_cover_path')) {
            $updatedBookData['book_cover_path'] = $request->file('book_cover_path')->store('book-covers', 'public');
        }

        if ($request->file('book_path')) {
            $updatedBookData['book_path'] = $request->file('book_path')->store('book-pdfs', 'public');
        }

        $book->update($updatedBookData);

        if (Auth()->user()->user_role === 'admin') {
            return redirect('/books')->with('success', 'Buku berhasil diperbarui!');
        }

        return redirect('/uploaded-books')->with('success', 'Buku berhasil diperbarui!');
    }
}
