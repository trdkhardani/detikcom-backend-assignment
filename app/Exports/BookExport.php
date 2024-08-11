<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $bookId;

    public function __construct($bookId)
    {
        $this->bookId = $bookId;
    }

    public function collection()
    {
        $book = Book::findOrFail($this->bookId);
        return collect([
            [
                'book_id' => $book->book_id,
                'category_name' => $book->category->category_name,
                'user_name' => $book->user->user_name,
                'title' => $book->book_title,
                'cover' => url('/storage/' . $book->book_cover_path),
                'desc' => $book->book_description,
                'total' => $book->book_total,
                'pdf' => url('/storage/' . $book->book_path),
            ]
        ]);
    }

    public function headings(): array
    {
        return [
            "ID_BUKU",
            "KATEGORI_BUKU",
            "PENGUNGGAH_BUKU",
            "JUDUL_BUKU",
            "LINK_COVER_BUKU",
            "DESKRIPSI_BUKU",
            "TOTAL_BUKU",
            "LINK_FILE_BUKU",
        ];
    }
}
