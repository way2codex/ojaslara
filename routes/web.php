<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

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

// Auth::routes();
Auth::routes(['register' => false]);

Route::get('/', [FrontController::class, 'index'])->name('home');


Route::get('/article/{id}/{slug}', [FrontController::class, 'article'])->name('article');
Route::get('/category/{id}/{slug}', [FrontController::class, 'category'])->name('category');
Route::get('/page/{slug}', [FrontController::class, 'page'])->name('page');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin_index');
    Route::get('/home', [AdminController::class, 'index'])->name('admin_home');

    Route::get('/category', [AdminController::class, 'category'])->name('admin.category');
    Route::get('/get_category', [AdminController::class, 'get_category'])->name('admin.get_category');
    Route::get('/add_category', [AdminController::class, 'add_category'])->name('admin.add_category');
    Route::post('/save_category', [AdminController::class, 'save_category'])->name('admin.save_category');
    Route::get('/edit_category/{category_id}', [AdminController::class, 'edit_category'])->name('admin.edit_category');
    Route::post('/update_category', [AdminController::class, 'update_category'])->name('admin.update_category');
    
    Route::get('/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/get_store', [AdminController::class, 'get_store'])->name('admin.get_store');
    Route::get('/add_store', [AdminController::class, 'add_store'])->name('admin.add_store');
    Route::post('/save_store', [AdminController::class, 'save_store'])->name('admin.save_store');
    Route::get('/edit_store/{store_id}', [AdminController::class, 'edit_store'])->name('admin.edit_store');
    Route::post('/update_store', [AdminController::class, 'update_store'])->name('admin.update_store');
    Route::get('/store_links/{store_id}', [AdminController::class, 'store_links'])->name('admin.store_links');
    Route::post('/save_store_links', [AdminController::class, 'save_store_links'])->name('admin.save_store_links');
    
    Route::get('/article', [AdminController::class, 'article'])->name('admin.article');
    Route::get('/get_article', [AdminController::class, 'get_article'])->name('admin.get_article');
    Route::get('/add_article', [AdminController::class, 'add_article'])->name('admin.add_article');
    Route::post('/save_article', [AdminController::class, 'save_article'])->name('admin.save_article');
    Route::get('/edit_article/{article_id}', [AdminController::class, 'edit_article'])->name('admin.edit_article');
    Route::post('/update_article', [AdminController::class, 'update_article'])->name('admin.update_article');
    
    Route::get('/add_article_widget/{article_id}', [AdminController::class, 'add_article_widget'])->name('admin.add_article_widget');
    Route::post('/save_article_widget', [AdminController::class, 'save_article_widget'])->name('admin.save_article_widget');

    Route::post('ck_article_upload', [AdminController::class, 'ck_article_upload'])->name('admin.ck_article_upload');
});
