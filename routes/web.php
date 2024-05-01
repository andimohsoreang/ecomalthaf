<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DetailsTransactionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\subcategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\Cart;
use App\Models\Promo;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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


// Route::get('/', [DashboardController::class, 'index'])->name('index.dashboard');

Route::get('/',[HomeController::class,'landingpage'])->name('landingpage');

Route::get('/login', [AuthController::class,'login'])->name('login');
Route::post('/login', [AuthController::class, 'doLogin'])->name('doLogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register',[AuthController::class, 'register'])->name('register');
Route::post('/register/do', [AuthController::class, 'doRegis'])->name('doRegis');


Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/home/promo', [HomeController::class, 'promo'])->name('home.promo');
Route::get('/productView/{id}', [HomeController::class, 'showProducts'])->name('showProducts');

Route::get('/addProductsToCart', [CartController::class, 'noLogin'])->name('noLogin');
Route::get('/carts', [CartController::class, 'carts'])->name('carts');

Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/store', [CartController::class, 'store'])->name('checkout.store');



Route::get('/details', [DetailsTransactionController::class, 'details'])->name('detailsOrder');
Route::get('/details/{id}', [DetailsTransactionController::class, 'show'])->name('detailsOrder.show');
Route::post('/details', [DetailsTransactionController::class, 'store'])->name('detailsOrder.store');





Route::middleware('auth')->group(function(){

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/users', [UserController::class, 'store'])->name('user.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('/customers', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');


    Route::get('/brands', [BrandController::class, 'index'])->name('brand.index');
    Route::get('/brands/create', [BrandController::class, 'create'])->name('brand.create');
    Route::post('/brands', [BrandController::class, 'store'])->name('brand.store');
    Route::get('/brands/{id}/edit', [BrandController::class, 'edit'])->name('brand.edit');
    Route::put('/brands/{id}', [BrandController::class, 'update'])->name('brand.update');
    Route::delete('/brands/{id}', [BrandController::class, 'destroy'])->name('brand.destroy');


    Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');


    Route::get('/subcategories', [SubcategoryController::class, 'index'])->name('subcategory.index');
    Route::get('/subcategories/create', [SubcategoryController::class, 'create'])->name('subcategory.create');
    Route::post('/subcategories', [SubcategoryController::class, 'store'])->name('subcategory.store');
    Route::get('/subcategories/{id}/edit', [SubcategoryController::class, 'edit'])->name('subcategory.edit');
    Route::put('/subcategories/{id}', [SubcategoryController::class, 'update'])->name('subcategory.update');
    Route::delete('/subcategories/{id}', [SubcategoryController::class, 'destroy'])->name('subcategory.destroy');

    Route::get('/products/fetch-subcategories', [ProductController::class, 'fetchSubcategories'])->name('product.fetchSubcategories');

    Route::get('/products', [ProductController::class, 'index'])->name('product.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::post('/products', [ProductController::class, 'store'])->name('product.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

    
    Route::get('/promos', [PromoController::class, 'index'])->name('promo.index');
    Route::get('/promos/create', [PromoController::class, 'create'])->name('promo.create');
    Route::post('/promos', [PromoController::class, 'getProdNoProm'])->name('promo.store');
    Route::get('/promos/{id}/edit', [PromoController::class, 'edit'])->name('promo.edit');
    Route::put('/promos/{id}', [PromoController::class, 'update'])->name('promo.update');
    Route::delete('/promos/{id}', [PromoController::class, 'destroy'])->name('promo.destroy');

    Route::get('/products-no-promo',[PromoController::class, 'getProdNoProm'])->name('getProdNoProm');

    Route::get('/orders', [TransactionController::class, 'index'])->name('order.index');
    Route::get('/orders/done', [TransactionController::class, 'indexDone'])->name('orderDone.index');
    Route::post('/orders/update', [TransactionController::class, 'updateStatus'])->name('updateStatus');
    Route::get('/orders/{id}', [TransactionController::class, 'show'])->name('order.show');
    Route::post('/orders/{id}', [TransactionController::class, 'store'])->name('order.store');
    Route::delete('/orders/{id}', [TransactionController::class, 'destroy'])->name('order.destroy');



});








