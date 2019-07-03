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
});

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
});

Route::post('editproductaltpic','ProductController@editproductaltpic');
Route::post('editproductpic','ProductController@editproductpic');
Route::post('managestock','ProductController@managestock');
Route::post('manageprodpriv','ProductController@manageprodpriv');
Route::post('editproddet','ProductController@editproddet');
Route::get('getfeatured','ProductController@getfeatured');
Route::get('featuredproducts','ProductController@featuredproducts');
Route::get('getdiscount','ProductController@getdiscount');
Route::get('flashsales','ProductController@flashsales');
Route::get('getmore','ProductController@getmore');
Route::get('shop','ProductController@shop');
Route::get('prodbycategories','ProductController@prodbycategories');
Route::get('admin/edituser','UserController@edituser');
Route::get('admin/updateuser','UserController@updateuser');
Route::get('admin/editstore','StoreController@editstore');
Route::get('admin/updatestore','StoreController@updatestore');
Route::get('/viewproduct/{id}', ['uses' =>'ProductController@singleproduct']);
Route::get('/allcatjson','CategoryController@allcatjson');