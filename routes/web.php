<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\SSEController;
use App\Http\Middleware\IsSupplier;

// Route::get('/sse', [SSEController::class, 'sendSSE']);
Route::get('/', [App\Http\Controllers\PagesController::class, 'index'])->name('welcome');
// google login
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

//Verify routes
Auth::routes();
Auth::routes(['verify' => true]);
//auth routes 
Route::get('/my-account', [App\Http\Controllers\HomeController::class, 'index'])->name('myaccount');
Route::delete('/my-account/request/{id}', [App\Http\Controllers\HomeController::class, 'deleteRequest'])->name('request.delete'); //delete existing requirement
Route::get('/checkout', [App\Http\Controllers\HomeController::class, 'checkout'])->name('checkout');
Route::get('/additional-information', [App\Http\Controllers\HomeController::class, 'extraInfo'])->name('extra.info');
Route::get('/get-start', [App\Http\Controllers\ShopController::class, 'index'])->name('shop.index')->middleware(['auth', 'verified']);

// admin
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->group(function () {

    Route::get('/add-product', [App\Http\Controllers\AdminController::class, 'addProduct'])->name('admin.addproduct');
    Route::get('/products', [App\Http\Controllers\AdminController::class, 'products'])->name('admin.products.index');
    Route::get('/product/edit/{id}', [App\Http\Controllers\AdminController::class, 'editProduct'])->name('admin.product.edit');
    Route::get('/orders', [App\Http\Controllers\AdminController::class, 'orders'])->name('admin.orders.index');
    Route::get('/orders/{id}', [App\Http\Controllers\AdminController::class, 'showOrders'])->name('admin.orders.show');
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.users.users');


});




// Route::get('/supplier/register', [App\Http\Controllers\SuppliersController::class, 'create'])->name('supplier.register');

// middleware is_supplier

// Route::middleware(['auth', IsSupplier::class])->prefix('supplier')->group(function () {
//     Route::get('/dashboard', [App\Http\Controllers\SuppliersController::class, 'index'])->name('supplier.dashboard');
//     Route::get('/dashboard/create-quoataion/{id}', [App\Http\Controllers\SuppliersController::class, 'createQuotation'])->name('supplier.create-quoatation');
// });

// Route::get('/.env', function(Request $request) {
//     abort(404);
// });

// Route::get('/{any}', function($any) {
//     if(str_starts_with($any, '.')) {
//         abort(404);
//     }
// })->where('any', '.*');
// artisan commands

// Route::get('/abc123', function () {
//     Artisan::call('migrate', ['--force' => true]);
//     return response()->json(['status' => 'Migration completed']);
// });;


// Route::get('/storage-link', function () {
//     Artisan::call('storage:link');
//     return response()->json(['status' => 'Storage link created']);
// })->middleware('auth');
