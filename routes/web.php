<?php

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

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/index', function () {
    return view('index');
});

Route::get('errors/404', function () {
    return view('404');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});
Route::get('/faq', function () {
    return view('faq');
});

Route::get('/termsandprivacy', function () {
    return view('termsandprivacy');
});

Route::get('/testimonial', function () {
    return view('testimonial');
});

// Route::get('/admin/users', function () {
//     return view('admin/users');
// });
Route::get('/admin/home', function () {
    return view('admin/home');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/signup', function () {
    return view('signup');
});
Route::post('/signup','UserController@signup');
Route::post('/login','UserController@login');
Route::get('/verifyemail', 'UserController@verifyemail');
Route::post('/resetcode', 'UserController@resetcode');
Route::get('/resetpassword', 'UserController@passwordreset');
Route::get('/logout','UserController@logout');
Route::get('/admin/users','UserController@allusers');
Route::get('/admin/category', function () { return view('admin/category');});
Route::post('/admin/addcategory','CategoryController@addcategory');
Route::get('/admin/allcategories','CategoryController@allcategories');
Route::get('/admin/addsubcat','CategoryController@addsubcat');
Route::get('/admin/editcat','CategoryController@editcat');
Route::get('/admin/viewsubcat','CategoryController@subcat_catid');
Route::get('/admin/store','StoreController@allstores');
Route::post('/admin/createstore','StoreController@createstore');
Route::get('admin/product/{storeid}', ['uses' =>'ProductController@storeproducts']);
Route::post('/admin/addproduct','ProductController@addproduct');

Route::get('product/storage/{filename}', function ($filename)
{
    $path = storage_path('/app/public/productpic/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    //$type = Storage::mimeType($path);

    $response = Response::make($file, 200);
    //$response->header("Content-Type", $type);

    return $response;
})->name('image.get');

Route::get('admin/edituser','UserController@edituser');
Route::get('admin/updateuser','UserController@updateuser');
Route::get('admin/editstore','StoreController@editstore');
Route::get('admin/updatestore','StoreController@updatestore');
Route::post('editproductaltpic','ProductController@editproductaltpic');
Route::post('editproductpic','ProductController@editproductpic');
Route::post('editproddet','ProductController@editproddet');
Route::get('prodbycategories','ProductController@prodbycategories');
Route::post('managestock','ProductController@managestock');
Route::post('manageprodpriv','ProductController@manageprodpriv');
Route::get('getfeatured','ProductController@getfeatured');
Route::get('featuredproducts','ProductController@featuredproducts');
Route::get('getdiscount','ProductController@getdiscount');
Route::get('flashsales','ProductController@flashsales');
Route::get('getmore','ProductController@getmore');
Route::get('shop','ProductController@shop');
Route::get('/viewproduct/{id}', ['uses' =>'ProductController@singleproduct'])->name('product.view');

// MANAGER ROUTES
Route::get('/manager/home', function () {
    return view('admin/home');
});
Route::get('manager/users',['uses' => 'UserController@allusers', 'name' => 'manager.users']);
Route::get('manager/edituser','UserController@edituser');
Route::get('manager/updateuser','UserController@updateuser');
Route::get('manager/editstore','StoreController@editstore');
Route::get('manager/updatestore','StoreController@updatestore');
Route::get('/manager/users','UserController@allusers');
Route::get('/manager/category', function () { return view('admin/category');});
Route::post('/manager/addcategory','CategoryController@addcategory');
Route::get('/manager/allcategories','CategoryController@allcategories');
Route::get('/manager/addsubcat','CategoryController@addsubcat');
Route::get('/manager/editcat','CategoryController@editcat');
Route::get('/manager/viewsubcat','CategoryController@subcat_catid');
Route::get('/manager/store','StoreController@allstores');
Route::post('/manager/createstore','StoreController@createstore');
Route::get('manager/product/{storeid}', ['uses' =>'ProductController@storeproducts']);
Route::post('/manager/addproduct','ProductController@addproduct');


/*
* ROUTES FOR ADMIN OPERATIONS
*/
Route::get('/admin/stores/list',['as' => 'admin.stores.list', 'uses' => 'StoreController@listStores']);
Route::get('/admin/colours',['as' => 'admin.colours', 'uses' => 'ColourController@index']);
Route::get('/admin/sizes',['as' => 'admin.sizes', 'uses' => 'SizeController@index']);
// Route::post('/admin/colours/delete',['as' => 'admin.colours.delete', 'uses' => 'ColourController@delete']);


/*
* ROUTES FOR VENDOR OPERATIONS
*/ 
Route::post('/vendor/register',['as' => 'vendor.create', 'uses' => 'VendorController@register']);

//GUARDED WITH VENDORONLY MIDDLEWARE TO ALLOW ONLY VENDORS ACCESS THE PAGES
Route::group(['middleware' => ['vendoronly','auth']],function(){
    Route::put('/vendor/update/{vendor_id}',['as' => 'vendor.update', 'uses' => 'VendorController@update']);
    Route::get('vendor/home',['as' => 'vendor.home', 'uses' => 'VendorController@index']);
    Route::get('vendor/settings',['as' => 'vendor.settings', 'uses' => 'VendorController@settings']);
    Route::get('vendor/products',['as' => 'vendor.products', 'uses' => 'VendorController@products']);
    Route::get('vendor/orders',['as' => 'vendor.orders', 'uses' => 'VendorController@orders']);
    // Route::get('vendor/products/update/quantity/{amount}',['as' => 'vendor.products.update.quantity', 'uses' => 'VendorController@updateProductQuantity']);
    // Route::get('api/vendor/products/{product_id}',['as' => 'api.vendor.products.single', 'uses' => 'VendorController@singleProductAPI']);
});

Route::get('/passwordz',function(){
   return bcrypt('pandora007');
});