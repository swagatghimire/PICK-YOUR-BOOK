<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    Auth\RegisterController,
    Auth\LoginController,
    AdminLoginController,
    ProfileController,
    AdminUserController,
    CategoryController,
    BookController,UserController
};

// Public Routes
Route::get('/', function () {
    return view('home');
})->name('home');

// Book Routes
Route::get('/', [BookController::class, 'home'])->name('home');
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/sellhere', [BookController::class, 'showSellForm'])->name('sellhere');
Route::post('/sellhere', [BookController::class, 'store'])->name('sellhere.store');
Route::get('/allbooks', [BookController::class, 'userIndex'])->name('allbooks');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');
Route::get('/book/{id}', [BookController::class, 'showd'])->name('book.details');
Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');
Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');

// Authentication Routes
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Authentication Routes
Route::get('admin/login', [AdminLoginController::class, 'index'])->name('admin.login');
Route::post('admin/login', [AdminLoginController::class, 'login']);
Route::post('admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

// Admin Routes
Route::prefix('admin')->middleware(['auth:admin'])->name('admin.')->group(function () {
    Route::get('dashboard', [AdminLoginController::class, 'dashboard'])->name('dashboard');

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [AdminUserController::class, 'showAllUsers'])->name('index');
        Route::post('/approve/{id}', [AdminUserController::class, 'approve'])->name('approve');
        Route::post('/decline/{id}', [AdminUserController::class, 'decline'])->name('decline');
        Route::delete('/delete/{id}', [AdminUserController::class, 'destroy'])->name('delete');
    });

    // Routes
Route::prefix('categories')->name('categories.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::post('/add', [CategoryController::class, 'storeCategory'])->name('store');
    Route::post('/update/{category}', [CategoryController::class, 'updateCategory'])->name('update');
    Route::delete('/delete/{category}', [CategoryController::class, 'destroyCategory'])->name('destroy');

    Route::prefix('subcategories')->name('subcategories.')->group(function () {
        Route::post('/', [CategoryController::class, 'storeSubcategory'])->name('store');
        Route::post('/{subcategory}', [CategoryController::class, 'updateSubcategory'])->name('update');
        Route::delete('/delete/{subcategory}', [CategoryController::class, 'destroySubcategory'])->name('destroy');
    });

    Route::prefix('subsubcategories')->name('subsubcategories.')->group(function () {
        Route::post('/', [CategoryController::class, 'storeSubsubcategory'])->name('store');
        Route::post('/{subsubcategory}', [CategoryController::class, 'updateSubsubcategory'])->name('update');
        Route::delete('/delete/{subsubcategory}', [CategoryController::class, 'destroySubsubcategory'])->name('destroy');
    });
});


    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [BookController::class, 'adminIndex'])->name('index');
        Route::delete('/{id}', [BookController::class, 'adminDestroy'])->name('destroy');
    });
});

// User Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/sellhere', [BookController::class, 'showSellForm'])->name('sellhere');
    Route::post('/sellhere', [BookController::class, 'store'])->name('sellhere.store');
    Route::get('/allbooks', [BookController::class, 'userIndex'])->name('allbooks');
    Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');
    Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');
    Route::get('/search', [BookController::class, 'search'])->name('search');
});



// Profile Routes
Route::middleware(['auth'])->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/{id}', [UserController::class, 'show'])->name('show');
    Route::put('/update', [UserController::class, 'update'])->name('update');
    Route::delete('/destroy', [UserController::class, 'destroy'])->name('destroy');  
    Route::post('/update-password', [UserController::class, 'updatePassword'])->name('password.change');

});




// Additional Category Routes for AJAX handling
Route::post('/admin/subcategories', [CategoryController::class, 'storeSubcategory'])->name('admin.subcategories.store');
Route::post('/admin/subsubcategories', [CategoryController::class, 'storeSubsubcategory'])->name('admin.subsubcategories.store');
Route::put('/admin/subcategories/{subcategory}', [CategoryController::class, 'updateSubcategory'])->name('admin.subcategories.update');
Route::delete('/admin/subcategories/{subcategory}', [CategoryController::class, 'destroySubcategory'])->name('admin.subcategories.destroy');
Route::get('/admin/categories/{categoryId}/subcategories', [CategoryController::class, 'getSubcategories'])->name('admin.categories.subcategories');
Route::put('/admin/subsubcategories/{id}', [CategoryController::class, 'updateSubsubcategory'])->name('admin.subsubcategories.update');
Route::delete('/admin/subsubcategories/{id}', [CategoryController::class, 'destroySubsubcategory'])->name('admin.subsubcategories.destroy');
Route::get('/admin/subcategories/{subcategoryId}/subsubcategories', [CategoryController::class, 'getSubsubcategories'])->name('admin.subcategories.subsubcategories');


Route::get('/password/change', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showChangePasswordForm'])->name('password.change');
Route::post('/password/change', [App\Http\Controllers\Auth\ResetPasswordController::class, 'changePassword'])->name('password.update');
