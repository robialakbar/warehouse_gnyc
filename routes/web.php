<?php

use Illuminate\Support\Facades\Route;
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

Auth::routes(['register' => false, 'reset' => false, 'verify' => false]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/search', [App\Http\Controllers\ProductController::class, 'search'])->name('search');
Route::prefix('products')->group(function () {
    Route::get('', [App\Http\Controllers\ProductController::class, 'products'])->name('products');
    Route::post('', [App\Http\Controllers\ProductController::class, 'product_save'])->name('products.save');
    Route::delete('', [App\Http\Controllers\ProductController::class, 'product_delete'])->name('products.delete')->middleware('adminRole');
    Route::get('/check/{pcode}', [App\Http\Controllers\ProductController::class, 'product_check'])->name('products.check');
    Route::post('/stockUpdate', [App\Http\Controllers\ProductController::class, 'product_stock'])->name('products.stock');
    Route::get('/stockHistory', [App\Http\Controllers\ProductController::class, 'product_stock_history'])->name('products.stock.history');
    Route::get('categories', [App\Http\Controllers\ProductController::class, 'categories'])->name('products.categories');
    Route::post('categories', [App\Http\Controllers\ProductController::class, 'categories_save'])->name('products.categories.save')->middleware('adminRole');
    Route::delete('categories', [App\Http\Controllers\ProductController::class, 'categories_delete'])->name('products.categories.delete')->middleware('adminRole');
    Route::get('barcode/{code}', [App\Http\Controllers\ProductController::class, 'generateBarcode'])->name('products.barcode');
    Route::post('import', [App\Http\Controllers\ProductController::class, 'product_import'])->name('products.import');
    Route::post('wipImport', [App\Http\Controllers\ProductController::class, 'product_wip_import'])->name('products.wip.import');
});

Route::prefix('users')->group(function () {
    Route::get('', [App\Http\Controllers\UserController::class, 'users'])->name('users')->middleware('adminRole');
    Route::delete('', [App\Http\Controllers\UserController::class, 'user_delete'])->name('users.delete')->middleware('adminRole');
    Route::post('', [App\Http\Controllers\UserController::class, 'user_save'])->name('users.save')->middleware('adminRole');
});

Route::prefix('roles_permissions')->group(function () {
    Route::get('', [App\Http\Controllers\RolePermissionController::class, 'roles_permissions'])->name('roles_permissions')->middleware('adminRole');
    Route::post('{id}', [App\Http\Controllers\RolePermissionController::class, 'role_permission_delete'])->name('roles_permissions.delete')->middleware('adminRole');
    Route::post('', [App\Http\Controllers\RolePermissionController::class, 'role_permission_save'])->name('roles_permissions.save')->middleware('adminRole');
});

Route::prefix('warehouse')->group(function () {
    Route::get('', [App\Http\Controllers\ProductController::class, 'warehouse'])->name('warehouse')->middleware('adminRole');
    Route::delete('', [App\Http\Controllers\ProductController::class, 'warehouse_delete'])->name('warehouse.delete')->middleware('adminRole');
    Route::post('', [App\Http\Controllers\ProductController::class, 'warehouse_save'])->name('warehouse.save')->middleware('adminRole');
    Route::get('change/{warehouse_id}', [App\Http\Controllers\ProductController::class, 'warehouse_select'])->name('warehouse.select');
});

Route::prefix('account')->group(function () {
    Route::get('', [App\Http\Controllers\UserController::class, 'myaccount'])->name('myaccount');
    Route::post('profile', [App\Http\Controllers\UserController::class, 'myaccount_update'])->name('myaccount.update');
    Route::post('password', [App\Http\Controllers\UserController::class, 'myaccount_update_password'])->name('myaccount.updatePassword');
});