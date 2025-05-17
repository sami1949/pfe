<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Http\Controllers\Client\OrderController as ClientOrderController;
use App\Http\Controllers\contactControllerClient;
use App\Http\Controllers\galleryControllerClient;
use App\Http\Controllers\ProductControllerClient;
use App\Http\Controllers\serviceControllerClient;
use App\Http\Controllers\welcomController;
use App\Http\Controllers\MakeupController;

Route::get('/', [welcomController::class, 'index'])->name('welcomeWithoutLogin');


Route::get('/client', [welcomController::class, 'index'])->middleware(['auth', 'verified'])->name('welcome');

//Route::get('/client', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('client');

Route::middleware('auth')->group(function () {
    Route::get('client/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('client/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('client/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Route::get('/client/product',[ProductControllerClient::class,"index"])->name('productClient');
    //Route::get('client/products/{category?}', [ProductControllerClient::class, 'index'])->name('productClient');
    Route::get('/client/service',[serviceControllerClient::class,"index"])->name('serviceClient');
    Route::get('/client/gallery',[galleryControllerClient::class,"index"])->name('galleryClient');
    Route::get('/client/contact',[contactControllerClient::class,"index"])->name('contactClient');
});

// Public product routes (no auth required)
Route::get('/product', [ProductControllerClient::class, "index"])->name('product.public');
Route::get('/product/{gender?}/{category?}', [ProductControllerClient::class, "index"])
    ->where(['gender' => 'homme|femme', 'category' => '.*'])
    ->name('product.public');

// Authenticated product routes
Route::middleware('auth')->group(function () {
    Route::get('/client/products', [ProductControllerClient::class, "index"])->name('product.private');
    Route::get('/client/products/{gender?}/{category?}', [ProductControllerClient::class, "index"])
        ->where(['gender' => 'homme|femme', 'category' => '.*'])
        ->name('product.private');
    
    // Cart routes
    Route::get('client/cart', function() {
        $userId = auth()->id() ?? 'guest';
        $cartKey = 'cart_'.$userId;
        $cartItems = json_decode(request()->cookie($cartKey), true) ?? [];
        
        return view('client.cart.index', [
            'cartItems' => $cartItems ?: []
        ]);
    })->name('cart');

    Route::get('client/cart/checkout', function() {
        return view('client.checkout.index', [
            'cartItems' => [],
            'total' => 0
        ]);
    })->name('checkout');
});

Route::post('client/cart/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');


//Souhail est ajouté cette partie🐱‍👤
Route::middleware(['auth','admin'])->group(function (){

    Route::get('admin/dashboard',[HomeController::class, 'index'])->name('dashboard');

    Route::get('admin/products',[ProductController::class, 'index'])->name('admin/products');

    Route::get('admin/users',[UsersController::class, 'index'])->name('admin/users');

    Route::get('admin/income',[IncomeController::class, 'index'])->name('admin/income');

    Route::get('admin/settings',[SettingsController::class, 'index'])->name('admin/settings');
});


// Products routes
Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index');
});


Route::get('client/products/makeup', [MakeupController::class, 'index'])
    ->middleware('auth')
    ->name('client.makeup.index');

Route::get('/products/makeup', [MakeupController::class, 'index'])
    ->name('public.makeup.index');




require __DIR__.'/auth.php';

//khaliw had les liens hna merci👀
//Route::get('admin/dashboard',[HomeController::class, 'index']);
//Route::get('admin/dashboard',[HomeController::class, 'index'])->middleware(['auth','admin']);