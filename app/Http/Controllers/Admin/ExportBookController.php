<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Exports\BookExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportBookController extends Controller
{
    public function exportBook($bookId)
    {
        return Excel::download(new BookExport($bookId), 'book_' . $bookId . '.xlsx');
    }
}
