<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');



Route::get('/','HomeController@index');


Route::get('category/{category_id}','ProductsController@category_products');

Route::get('shop','ProductsController@all_products');

Route::group(['middleware'=>['auth']], function (){
    Route::get('cart','CartController@cart');
    Route::get('cart/add/{product_id}','CartController@add_to_cart');

    Route::get('dashboard','DashboardController@dashboard');//->middleware('perm:1');


    Route::get('admin/categories','ProductsController@categories');//->middleware('perm:1');
    Route::post('admin/categories','ProductsController@add_category');//->middleware('perm:1');
    Route::post('admin/categories/delete','ProductsController@delete_category');//->middleware('perm:1');

    Route::get('admin/category/edit/{id}','ProductsController@edit_category')->name('edit-category');
    Route::post('admin/category/update','ProductsController@update_category');//->middleware('perm:1');




});

