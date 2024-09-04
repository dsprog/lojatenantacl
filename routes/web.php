<?php

use App\Models\Store;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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

Route::domain('{subdomain}.localhost')
->controller(\App\Http\Controllers\Front\StoreController::class)
->group(function(){
    Route::get("/", 'index')->name('front.store');
    
    Route::prefix('cart')->name('cart.')
    ->controller(\App\Http\Controllers\Front\CartController::class)
    ->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('add/{product}', 'add')->name('add');
        Route::get('remove/{product}', 'remove')->name('remove');
        Route::get('cancel', 'cancel')->name('cancel');
    });
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    //dd(Store::all());
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')->name('admin.')->group(function(){
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
