<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ListCategoryController;
use App\Http\Controllers\Admin\UpdateCategoryController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Books\BookController;
use App\Http\Controllers\Books\BookDetailController;
use App\Http\Controllers\Books\CreateBookController;
use App\Http\Controllers\Books\DeleteBookController;
use App\Http\Controllers\Books\UpdateBookController;
use App\Http\Controllers\Books\UploadedBooksController;
use App\Http\Controllers\Register\RegisterController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Middleware\IsAdmin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::view('/', 'home', [
    'pageTitle' => 'Beranda',
    'active' => '',
]);

Route::get('/books', [BookController::class, 'index']);

Route::middleware('guest')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'loginPage')->name('login');
        Route::post('/login', 'authenticate');
    });

    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'index');
        Route::post('/register', 'register');
    });
});

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::middleware(IsAdmin::class)->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index']);
        Route::get('/categories-list', [ListCategoryController::class, 'index']);

        Route::controller(UpdateCategoryController::class)->group(function(){
            Route::get('/edit-category/{category_id}', 'index');
            Route::put('/edit-category/{category_id}', 'updateCategory');
        });
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard']);

    Route::controller(CreateBookController::class)->group(function(){
        Route::get('/add-book', 'index');
        Route::post('/add-book', 'createBook');
    });

    Route::get('/uploaded-books', [UploadedBooksController::class, 'index']);

    Route::get('/book/{book_id}', [BookDetailController::class, 'index']);

    Route::controller(UpdateBookController::class)->group(function(){
        Route::get('/edit-book/{book_id}', 'index');
        Route::put('/edit-book/{book_id}', 'updateBook');
    });

    Route::delete('/delete-book/{book_id}', [DeleteBookController::class, 'deleteBook']);
});
