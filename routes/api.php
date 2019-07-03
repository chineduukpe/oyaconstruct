<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//GUARDED WITH VENDORONLY MIDDLEWARE TO ALLOW ONLY VENDORS ACCESS THE PAGES
Route::group([],function(){

    Route::post('/admin/colours/delete',['as' => 'admin.colours.delete', 'uses' => 'ColourController@delete']);
    Route::post('/admin/colours/add',['as' => 'admin.colours.add', 'uses' => 'ColourController@add']);
    Route::post('/admin/colours/update',['as' => 'admin.colours.edit', 'uses' => 'ColourController@update']);
    Route::post('/admin/sizes/delete',['as' => 'admin.sizes.delete', 'uses' => 'SizeController@delete']);
    Route::post('/admin/sizes/add',['as' => 'admin.sizes.add', 'uses' => 'SizeController@add']);
    Route::post('/admin/sizes/update',['as' => 'admin.sizes.edit', 'uses' => 'SizeController@update']);
    Route::post('vendor/products/update/quantity',['as' => 'api.vendor.products.update.quantity', 'uses' => 'VendorController@updateProductQuantityAPI']);
    Route::get('vendor/products/{product_id}',['as' => 'api.vendor.products.single', 'uses' => 'VendorController@singleProductAPI']);

    Route::post('admin/product/price/add','ProductController@addProductPrice')->name('admin.product.price.add');
    Route::get('admin/product/delete/{product_id}','ProductController@deleteProduct')->name('admin.product.delete');
});
