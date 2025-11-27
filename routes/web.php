<?php

// use App\Http\Controllers\ProfileController;
// use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });





// require __DIR__.'/auth.php';

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\AdminController;

Route::get('/', [HomeController::class, 'index'])->name('home');



// Contact
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Protected routes
Route::middleware('auth')->group(function () {

    Route::get('/profile', function() {
        return view('profile.edit');
    })->name('profile.edit');
    
    Route::get('/messages', [MessageController::class, 'index'])
        ->name('messages.index');

    // Route::resource('crud', CrudController::class)->expect(['show']);
    Route::resource('crud', CrudController::class)->except(['show']);

    Route::get('/admin', [AdminController::class, 'index'])
        ->middleware('can:admin')
        ->name('admin');

    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])
        ->middleware('can:admin')
        ->name('admin.users.delete');

});

require __DIR__.'/auth.php';