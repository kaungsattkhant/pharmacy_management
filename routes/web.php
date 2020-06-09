<?php

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
//Route::get('/',function (){
//    return view('StaffAuth.staff_index');
//});
Route::group(['middleware'=>['admin']],function() {
    Route::group(['namespace'=>'Web'],function() {
        Route::group(['prefix'=>'staff'],function(){
            Route::get('/','StaffController@index');
            Route::post('/store','StaffController@store');
            Route::get('{id}/edit','StaffController@edit');
            Route::post('update','StaffController@update');
            Route::post('destroy','StaffController@destroy');
        });
        Route::group(['prefix'=>'branch'],function(){
            Route::get('/','BranchController@index');
            Route::post('/store','BranchController@store');
            Route::get('{id}/edit','BranchController@edit');
            Route::post('update','BranchController@update');
            Route::post('destroy','BranchController@destroy');

        });
        Route::group(['prefix'=>'item'],function(){
            Route::get('/','ItemController@index');
            Route::post('/store','ItemController@store');
            Route::get('{id}/edit','ItemController@edit');
            Route::post('update','ItemController@update');
            Route::post('destroy','ItemController@destroy');
            Route::post('add_qty','ItemController@item_add_qty');
            Route::get('search','ItemController@search');
        });
        Route::group(['prefix'=>'category'],function(){
            Route::get('/','CategoryController@index');
            Route::post('/store','CategoryController@store');
            Route::get('{id}/edit','CategoryController@edit');
            Route::post('update','CategoryController@update');
            Route::post('destroy','CategoryController@destroy');
        });
    });
});
Route::group(['middleware'=>['frontman']],function() {
    Route::group(['namespace' => 'Web'], function () {
        Route::group(['prefix'=>'sale'],function(){
            Route::get('/','SaleController@index');
            Route::get('get_item_name','SaleController@get_item_name');
            Route::post('create','SaleController@sale_create');
            Route::get('sale_record','SaleController@sale_record');
        });
        Route::group(['prefix'=>'pos'],function(){
            Route::get('/','POSController@index');
            Route::get('get_item_name','POSController@get_item_name');
//            Route::post('create','POSController@sale_create');
        });
    });
});
Route::group(['namespace'=>'Web'],function() {
//    Route::get('/','StaffController@index');
    Route::get('/','LoginController@index');
    Route::get('login','LoginController@index');
    Route::post('login','LoginController@login');
    Route::match(['get','post'],'logout',"LoginController@logout");

});
