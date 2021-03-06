<?php

use App\Http\Controllers\CartsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductCategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductImagesController;
use App\Http\Controllers\ProductTagsController;
use App\Http\Controllers\User\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// =============== User ================
Route::group(['prefix' => 'users'], function() {
    Route::post('/', [RegisterController::class, 'create']);
}); 
// =============== Products ================
Route::group(['prefix' => 'products'] , function() {
    Route::post('/',        [ProductsController::class, 'create']);
    Route::put('/{slug}',     [ProductsController::class, 'update']);
    Route::delete('/{slug}',  [ProductsController::class, 'delete']);
    Route::get('/{slug}',     [ProductsController::class, 'find']);
    Route::get('/paginate/{paginate}/status={status}',         [ProductsController::class, 'products']);
    Route::put('/archive/{id}', [ProductsController::class, 'archiveProduct']);
    Route::put('/restore/{id}', [ProductsController::class, 'restoreProduct']);
});
// =============== Product Images ================
Route::group(['prefix' => 'product-images'], function() {
    Route::post('/',    [ProductImagesController::class, 'create']);
    Route::put('/{slug}', [ProductImagesController::class, 'update']);
    Route::delete('/{id}', [ProductImagesController::class, 'delete']);
    Route::put('/{id}', [ProductImagesController::class, 'update']);
});
// =============== Product Tags ================
Route::group(['prefix' => 'product-tags'] ,function() {
    Route::post('/', [ProductTagsController::class, 'create']);
    Route::delete('/{id}', [ProductTagsController::class, 'delete']);
    Route::put('/', [ProductTagsController::class, 'update']);
});
// =============== Carts ================
Route::group(['prefix' => 'carts'], function() {
    Route::post('/', [CartsController::class, 'create']);
    Route::get('/{id}', [CartsController::class, 'carts']); // GET USER CARTS
    Route::delete('/{id}', [CartsController::class, 'delete']);
});

Route::group(['prefix' => 'categories'], function() {
    Route::get('/paginate={paginate}', [CategoriesController::class, 'categories']);
    Route::post('/', [CategoriesController::class, 'create']);
    Route::delete('/{slug}', [CategoriesController::class, 'delete']);
    Route::put('/{slug}', [CategoriesController::class, 'update']);
});

Route::group(['prefix' => 'product-categories'], function() {
    Route::post('/', [ProductCategoriesController::class, 'create']);
});