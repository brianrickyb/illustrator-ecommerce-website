<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

//Belum Login
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/commission', [UserController::class, 'commission'])->name('commission');
Route::get('/about', [UserController::class, 'about'])->name('about');
Route::get('/shop', [UserController::class, 'shop'])->name('shop');
Route::get('/homeproductdetail/{id}', [UserController::class, 'homeproductDetail'])->name('homeproductDetail');
Route::get('/shopproductdetail/{id}', [UserController::class, 'shopproductDetail'])->name('shopproductDetail');

//Udah Login
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');
    Route::get('/home/profileuser', [UserController::class, 'profileuser'])->name('profileuser');
    Route::put('/home/profileuser', [UserController::class, 'updateProfile'])->name('updateProfile');
    Route::get('/home/commission', [UserController::class, 'commission'])->name('commission');
    Route::get('/home/about', [UserController::class, 'about'])->name('about');
    Route::get('/home/shop', [UserController::class, 'shop'])->name('shop');
    Route::get('/home/shopping-cart', [UserController::class, 'index'])->name('shopping-cart.get');
    Route::post('/home/shopping-cart', [UserController::class, 'store'])->name('add_to_shopping-cart');
    Route::post('/home/shopping-cart/{id}', [UserController::class, 'shopping_cart'])->name('shopping-cart');
    Route::post('/home/thankyou', [UserController::class, 'thanks'])->name('thanksPage');
    Route::get('/home/homeproductdetail/{id}', [UserController::class, 'homeproductDetail'])->name('homeproductDetail');
    Route::get('/home/shopproductdetail/{id}', [UserController::class, 'shopproductDetail'])->name('shopproductDetail');
    Route::post('/updateCartItem', [UserController::class, 'update'])->name('updateCartItem');
    Route::post('/removeCartItem', [UserController::class, 'destroy'])->name('removeCartItem');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('home/admin/orderHistory', [AdminController::class, 'history'])->name('history');
    Route::resource('product', AdminController::class);
    Route::resource('admin', AdminController::class);
    Route::get('home/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::get('home/admin/{id}', [AdminController::class, 'show'])->name('admin.show');
    Route::get('home/admin/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
