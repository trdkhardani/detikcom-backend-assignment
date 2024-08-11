<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeleteBookController extends Controller
{
    public function deleteBook($bookId)
    {
        $userId = Auth()->user()->user_id;
        $book = Book::findOrFail($bookId);

        if ($book->user->user_id !== $userId && Auth()->user()->user_role !== 'admin') {
            abort(403);
        }

        Storage::disk('public')->delete($book->book_cover_path); // hapus cover buku
        Storage::disk('public')->delete($book->book_path); // hapus pdf buku


        $book->delete();

        if (Auth()->user()->user_role === 'admin') {
            return redirect('/books')->with('success', 'Buku berhasil dihapus!');
        }

        return redirect('/uploaded-books')->with('success', 'Buku berhasil dihapus!');
    }
}
