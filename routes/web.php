<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PyqController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\MeetupController;
use App\Http\Controllers\TransactionController;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminStudentController;
use App\Http\Controllers\Admin\AdminBookController;
use App\Http\Controllers\Admin\AdminTransactionController;
use App\Http\Controllers\Admin\AdminPyqController;
use App\Http\Controllers\Admin\ValidStudentImportController;
use App\Http\Controllers\Admin\AdminProfileController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/books/browse', [BookController::class, 'browse'])
    ->name('books.browse');

Route::middleware('auth')->group(function () {

    Route::get('/books/add', [BookController::class, 'add'])
        ->name('books.add');
        
     Route::post('/books/store', [BookController::class, 'store'])->name('books.store');

    Route::get('/books/listings', [BookController::class, 'myListings'])
        ->name('books.listings');
        
    Route::patch('/books/{book}/sold', [BookController::class, 'markAsSold'])
    ->name('books.sold');

     Route::get('/books/profile', [ProfileController::class, 'index'])
        ->name('books.profile');

     Route::post('/profile/update', [ProfileController::class, 'update'])
        ->name('profile.update');

     Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])
        ->name('profile.password.update');


});

Route::get('/books/{book}/edit', [BookController::class, 'edit'])
    ->name('books.edit');

Route::put('/books/{book}', [BookController::class, 'update'])
    ->name('books.update');

Route::delete('/books/{book}', [BookController::class, 'destroy'])
    ->name('books.destroy');




    // pyq page
Route::get('/pyq', [PyqController::class, 'index'])
    ->name('pyq.index');


Route::middleware('auth')->group(function () {
    Route::get('/pyq/upload', [PyqController::class, 'upload'])
        ->name('pyq.upload');
        
     Route::post('/pyq/upload', [PyqController::class, 'store'])->name('pyq.store');

     Route::get('/pyq/{pyq}/download', [PyqController::class, 'download'])
    ->name('pyq.download');
});

Route::get('/pyq/{id}', [PyqController::class, 'show'])
    ->name('pyq.show');

Route::middleware('auth')->group(function () {
    Route::get('/my-requests', [RequestController::class, 'index'])
        ->name('books.request');
        
     Route::get('/books/{book}/request', [RequestController::class, 'create'])
        ->name('book.request.create');

     Route::post('/books/{book}/request', [RequestController::class, 'store'])
        ->name('book.request.store');

      Route::post('/requests/{request}/accept', [RequestController::class, 'accept'])
        ->name('requests.accept');

    Route::post('/requests/{request}/reject', [RequestController::class, 'reject'])
        ->name('requests.reject');

// meetup
//   Route::get('/meetups/{transaction}/create', [MeetupController::class, 'create'])
//         ->name('meetups.create');

    Route::post('/meetups/{transaction}', [MeetupController::class, 'store'])
        ->name('meetups.store');

    Route::post('/meetups/{meetup}/confirm', [MeetupController::class, 'confirm'])
        ->name('meetups.confirm');

    // transaction
     Route::post('/transactions/{transaction}/buyer-confirm', [TransactionController::class, 'buyerConfirm'])
        ->name('transactions.buyer.confirm');

    Route::post('/transactions/{transaction}/seller-confirm', [TransactionController::class, 'sellerConfirm'])
        ->name('transactions.seller.confirm');

});


// admin page
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/students', [AdminStudentController::class, 'index'])
            ->name('students');

        Route::patch('/students/{user}/suspend', [AdminStudentController::class, 'suspend'])
            ->name('students.suspend');

        Route::patch('/students/{user}/activate', [AdminStudentController::class, 'activate'])
            ->name('students.activate');

        Route::get('/books', [AdminBookController::class, 'index'])
            ->name('books');

        Route::delete('/books/{book}', [AdminBookController::class, 'destroy'])
            ->name('books.destroy');

        Route::patch('/books/{book}/status', [AdminBookController::class, 'updateStatus'])
            ->name('books.status');

        Route::get('/transactions', [AdminTransactionController::class, 'index'])
            ->name('transactions');

        Route::get('/pyqs', [AdminPyqController::class, 'index'])
            ->name('pyqs');

        Route::patch('/pyqs/{pyq}/verify', [AdminPyqController::class, 'verify'])
            ->name('pyqs.verify');

        Route::delete('/pyqs/{pyq}', [AdminPyqController::class, 'destroy'])
            ->name('pyqs.destroy');
         

     });
     
           // profile page
        Route::get('/admin/profile', function () {
       return view('admin.profile');
       })->name('admin.profile');

         Route::post('/profile/update', [AdminProfileController::class, 'update'])
        ->name('profile.update');

      Route::post('/profile/change-password', [AdminProfileController::class, 'changePassword'])
      ->name('profile.password.update');



Route::post('/admin/valid-students/import',
    [ValidStudentImportController::class, 'store'])
    ->name('admin.valid-students.import');