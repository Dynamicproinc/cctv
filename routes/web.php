<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\SSEController;
use App\Http\Middleware\IsSupplier;

Route::get('/sse', [SSEController::class, 'sendSSE']);

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/product/{id}', function ($id) {
//     return view('welcome');
// });

// Route::get('locale\{lang}',[App\Http\Controllers\LocalizationController::class, 'setLocale']);

Auth::routes();
Auth::routes(['verify' => true]);
//account
Route::get('/my-account', [App\Http\Controllers\HomeController::class, 'index'])->name('myaccount');
//delete request
Route::delete('/my-account/request/{id}', [App\Http\Controllers\HomeController::class, 'deleteRequest'])->name('request.delete');
// Route::get('/reviews/{product_slug}', [App\Http\Controllers\ReviewsController::class, 'showReviews'])->name('product.reviews');
// Route::get('/my-account', [App\Http\Controllers\HomeController::class, 'index'])->name('myaccount');
// Route::get('/my-account/order/{slug}', [App\Http\Controllers\HomeController::class, 'viewOrder'])->name('myaccount.vieworder');
// Route::get('/my-account/orders', [App\Http\Controllers\HomeController::class, 'orders'])->name('myaccount.orders');
// Route::get('/my-account/coupons', [App\Http\Controllers\HomeController::class, 'coupons'])->name('myaccount.coupons');
Route::get('/checkout', [App\Http\Controllers\HomeController::class, 'checkout'])->name('checkout');
Route::get('/addtional-information', [App\Http\Controllers\ShopController::class ,'extraInfo'])->name('extra.info');



Route::get('/', [App\Http\Controllers\ShopController::class, 'index'])->name('shop.index');
Route::get('/my-quote', [App\Http\Controllers\ShopController::class, 'index'])->name('shop.index');
// Route::get('/shop', [App\Http\Controllers\ShopController::class, 'index'])->name('shop.index');
Route::get('/category/{category}', [App\Http\Controllers\ShopController::class, 'category'])->name('shop.category');
// Route::get('/shop/{slug}', [App\Http\Controllers\ShopController::class, 'showProduct'])->name('shop.showproduct');
// Route::get('/cart', [App\Http\Controllers\ShopController::class, 'cart'])->name('shop.cart')->middleware(['auth','verified']);

Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->group(function () {
    
    Route::get('/add-product', [App\Http\Controllers\AdminController::class,'addProduct'])->name('admin.addproduct');
    Route::get('/products', [App\Http\Controllers\AdminController::class,'products'])->name('admin.products.index');
    Route::get('/reviews', [App\Http\Controllers\AdminController::class,'reviews'])->name('admin.reviews');
    Route::get('/product/edit/{id}', [App\Http\Controllers\AdminController::class,'editProduct'])->name('admin.product.edit');
    Route::get('/kitchen',[App\Http\Controllers\AdminController::class,'kitchen'])->name('admin.kitchen');
    Route::get('/add-coupon',[App\Http\Controllers\AdminController::class,'addCoupone'])->name('admin.product.coupon');
    Route::get('/point-manager',[App\Http\Controllers\AdminController::class,'pointManager'])->name('admin.point.pointmanager');
    Route::get('/orders',[App\Http\Controllers\AdminController::class,'orders'])->name('admin.orders.index');
    Route::get('/orders/{id}',[App\Http\Controllers\AdminController::class,'showOrders'])->name('admin.orders.show');
    Route::get('/users',[App\Http\Controllers\AdminController::class,'users'])->name('admin.users.users');
    Route::get('/order-notification',[App\Http\Controllers\AdminController::class,'orderNotification'])->name('admin.orders.notification');
    Route::get('/setting/shop-status',[App\Http\Controllers\AdminController::class,'changeShostatus'])->name('admin.setting.shopstatus');
    Route::get('/extract-emails',[App\Http\Controllers\AdminController::class,'extractEmails'])->name('admin.users.extractemails');
});



// suppliers
Route::get('/supplier/register', [App\Http\Controllers\SuppliersController::class, 'create'])->name('supplier.register');

// middleware is_supplier

Route::middleware(['auth', IsSupplier::class])->prefix('supplier')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\SuppliersController::class, 'index'])->name('supplier.dashboard');
    Route::get('/dashboard/create-quoataion/{id}', [App\Http\Controllers\SuppliersController::class, 'createQuotation'])->name('supplier.create-quoatation');
});

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
