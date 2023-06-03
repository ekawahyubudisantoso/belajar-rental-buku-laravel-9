<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index',[
        'title' => 'Home',
    ]);
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'registerProcess']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/dashboard/books', [BookController::class, 'index']);

    Route::get('/dashboard/categories/checkSlug', [CategoryController::class, 'checkSlug']);
    Route::get('/dashboard/categories', [CategoryController::class, 'index']);
    Route::get('/dashboard/categories/create', [CategoryController::class, 'create']);
    Route::post('/dashboard/categories/create', [CategoryController::class, 'store']);
    Route::get('/dashboard/categories/edit/{slug}', [CategoryController::class, 'edit']);
    Route::put('/dashboard/categories/edit/{slug}', [CategoryController::class, 'update']);
    Route::delete('/dashboard/categories/delete/{slug}', [CategoryController::class, 'destroy']);
    Route::get('/dashboard/categories/deleted', [CategoryController::class, 'deleted']);
    Route::get('/dashboard/categories/restore/{slug}', [CategoryController::class, 'restore']);
    Route::delete('/dashboard/categories/force-delete/{slug}', [CategoryController::class, 'forceDelete']);

    // Route::resource('/dashboard/categories', CategoryController::class);

});