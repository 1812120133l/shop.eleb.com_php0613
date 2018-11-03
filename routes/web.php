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
    return view('welcome');
});

Route::get('/user','Users\UserController@user')->name('user');
Route::post('/user/register','Users\UserController@register')->name('user.register');

Route::get('/user/index','Users\UserController@index')->name('login');
Route::post('/user/userlogin','Users\UserController@userlogin')->name('user.userlogin');
Route::get('/user/destroy','Users\userController@destroy')->name('user.destroy');
Route::get('/user/edit','Users\userController@edit')->name('user.edit');
Route::post('/user/update','Users\userController@update')->name('user.update');

Route::get('/shop','Shop\ShopController@index')->name('shop.index');
//Route::get('/shop/{}','Shop\ShopController@index')->name('shop.index');

Route::resource('menucategory','Menu\MenuCategoryController');

Route::resource('menu','Menu\MenuController');

Route::post('upload','Menu\MenuController@upload')->name('upload');

Route::get('order/index','Orders\OrderController@index')->name('order.index');
Route::get('order/list','Orders\OrderController@list')->name('order.list');
Route::get('order/stat','Orders\OrderController@stat')->name('order.stat');
Route::get('order/cancel','Orders\OrderController@cancel')->name('order.cancel');

Route::get('order/greens','Orders\OrderController@greens')->name('order.greens');
