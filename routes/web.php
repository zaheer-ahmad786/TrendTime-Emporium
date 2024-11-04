<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Auth::routes();
// Home page View
Route::get('/', [HomeController::class, 'index'])->name('home.index');

// User Auth
Route::middleware(['auth'])->group(function(){
    Route::get('/account-dashboard',[UserController::class,'index'])->name('user.index');
});


// Admin Auth
Route::middleware(['auth',AuthAdmin::class])->group(function(){
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware('auth');
    // Brand Route
Route::get('admin/brands', [AdminController::class, 'brands_index'])->name('admin.brands'); // Display the list of brands
Route::get('/admin/brand/add',[AdminController::class,'add_brand'])->name('admin.brand.add');
Route::post('/admin/brand/store',[AdminController::class,'brand_store'])->name('admin.brand.store');
Route::get('/admin/brands/{id}/edit',[AdminController::class,'edit_brand'])->name('admin.brand.edit');
Route::post('/admin/brand/{id}/update',[AdminController::class,'update_brand'])->name('admin.brand.update');
Route::get('/admin/brand/{id}/delete',[AdminController::class,'delete_brand'])->name('admin.brand.delete');
// Categories Route
Route::get('admin/categories', [AdminController::class, 'categories_index'])->name('admin.categories'); // Display the list of brands
Route::get('/admin/categories/add',[AdminController::class,'categories_brand'])->name('admin.categories.add');
Route::post('/admin/categories/store',[AdminController::class,'categories_store'])->name('admin.categories.store');
Route::get('/admin/categories/{id}/edit',[AdminController::class,'edit_categories'])->name('admin.categories.edit');
Route::post('/admin/categories/{id}/update',[AdminController::class,'update_categories'])->name('admin.categories.update');
Route::get('/admin/categories/{id}/delete',[AdminController::class,'delete_categories'])->name('admin.categories.delete');
});



