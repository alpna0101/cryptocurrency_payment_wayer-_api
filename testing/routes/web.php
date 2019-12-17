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
    return view('login');
});

Route::get('/create_account', function () {
    return view('create_account');
});
Route::get('/upload_document', function () {
    return view('upload_document');
});
Route::get('/preview_account', function () {
    return view('preview_account');
});
Route::get('/preview_payment', function () {
    return view('preview_payment');
});
Route::get('/payment', function () {
    return view('payment');
});
Route::get('/blockchain', function () {
    return view('blockchain');
});

Route::get('/create_transfer', function () {
    return view('create_transfer');
});


Route::get('/transfer', function () {
    return view('transfer');
});

Route::post('postmydata','UserController@postmydata');
Route::get('logout','UserController@logout');
Route::post('login','UserController@login');
Route::post('transferdata','UserController@transferdata');
Route::post('upload_doc','UserController@upload_doc');
Route::get('store_data','UserController@store_data');
Route::get('reteive_account','UserController@reteive_account');
Route::get('doc_test','UserController@doc_test');




