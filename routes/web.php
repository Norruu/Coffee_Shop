<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CoffeeController;
use App\Http\Controllers\CartController;
use App\Models\Coffee;
use Illuminate\Support\Facades\Route;

// Public Routes (Keep your existing public routes here)
Route::get('/', function () {
    $coffees = Coffee::latest()->take(6)->get();
    return view('welcome', compact('coffees'));
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

// Regular User Routes
Route::middleware(['auth', 'verified'])->group(function () {
    
    // User Dashboard (Shows Menu)
    Route::get('/dashboard', function () {
        // Fetch coffees with pagination (9 per page)
        $coffees = \App\Models\Coffee::paginate(9);
        return view('dashboard', compact('coffees'));
    })->name('dashboard');

    // Cart Routes
        // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    
    // Add this new route:
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Only Routes
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->group(function () {
    // Admin Dashboard (CRUD table)
    Route::get('/dashboard', [CoffeeController::class, 'index'])->name('admin.dashboard');
    Route::resource('coffees', CoffeeController::class)->except(['index', 'show']);
});

require __DIR__.'/auth.php';