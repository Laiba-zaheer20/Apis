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

Route::get('/',function(){
  return redirect('login');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>['auth','admin']],function(){

Route::get('/index',function(){
    return view('layouts.index');
  });
  Route::get('/dashboard',function(){
    return view('admin.dashboard');
  });
  Route::get('/home',function(){
    return redirect('dashboard');
  });
// //media
//   Route::get('/media','MediaController@index');
//   Route::post('/addmedia1','MediaController@store1')->name('addmedia1');
//   Route::post('/addmedia2','MediaController@store2')->name('addmedia2');
//   Route::post('/addmedia3','MediaController@store3')->name('addmedia3');

//   Route::post('/settingchanges','MediaController@settingchanges')->name('settingchanges');
//   Route::get('/imageshow','MediaController@imgshow')->name('imageshow');
//   Route::post('/deletemedia','MediaController@delete')->name('delete');
//   Route::get('/detail','MediaController@detail')->name('detail');
//   Route::get('/setting','MediaController@setting')->name('settings');


  //category
  Route::get('/category','CategoryController@index');
  Route::get('/delcat','CategoryController@destroy')->name('delcat');
  Route::post('/addcat','CategoryController@store')->name('addcat');
  Route::post('/updatecat','CategoryController@update')->name('updatecat');
  Route::get('/addcat','CategoryController@addcat');

  //book
  Route::post('/addbook','bookController@store')->name('addbook');
  // //subcategory
  // Route::get('/subcategory','SubcategoryController@index');
  // Route::get('/delsubcat','SubcategoryController@destroy')->name('delsubcat');
  // Route::post('/updatesubcat','SubcategoryController@update')->name('updatesubcat');
  // Route::get('fetchsubcat','SubcategoryController@fetchsubcat')->name('fetchsubcat');
  // Route::get('subcategory/fetch_data','SubcategoryController@fetch_data');
  // //product
  // Route::get('/product','ProductController@index');
  // Route::get('product/fetch_data', 'ProductController@fetch_data');
  // Route::get('/delprd','ProductController@destroy')->name('delprd');
  // Route::post('/updateprd','ProductController@update')->name('updateprd');
  // Route::get('/fetchprd','ProductController@fetchprd')->name('fetchprd');
  // Route::get('/filterprd','ProductController@filterprd')->name('filterprd');
  // //order
  // Route::get('/order','OrderController@index');
  // Route::get('/orderreport','OrderController@report');
  // Route::get('/vieworder','OrderController@vieworder')->name('vieworder');
  // Route::get('/getorder','OrderController@getorder');
  // Route::get('/getprd','OrderController@getprd');
  // Route::get('/getorderdate','OrderController@getorderdate');

 // //inventory
//   Route::get('find','InventoryController@find')->name('find');
//   Route::get('add','InventoryController@add')->name('add');

//  // Route::post('searchsubcat','InventoryController@searchsubcat')->name('searchsubcat');
//   Route::get('/inventory','InventoryController@display');
//   Route::get('/view','InventoryController@view');
  

});
