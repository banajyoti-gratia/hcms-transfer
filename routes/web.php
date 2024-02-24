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

Route::get('/login', 'ALoginController@index')->name('login');
Route::post('/post-login', 'ALoginController@postLogin')->name('post-login');
Route::get('/dashboard', 'ALoginController@index_dashboard')->name('dashboard');
Route::get('/logout', 'ALoginController@logout')->name('logout');
Route::get('/error', 'ALoginController@error')->name('error');

/* Route for Transfer Employee */
Route::get('/transfer-dashboard', 'TransferController@index')->name('transfer-dashboard');
Route::get('/get-block', 'TransferController@getBlock')->name('get-block');
Route::get('/get-gp', 'TransferController@getGramPanchayat')->name('get-gp');
Route::get('/get-designation', 'TransferController@getDesignation')->name('get-designation');
Route::get('/get-employee-deatils', 'TransferController@employeeDetails')->name('get-employee-deatils');
Route::post('/view-employee-list', 'TransferController@employeeListView')->name('get-employee-list');
Route::post('/transfer-employee', 'TransferController@employeeTransfer')->name('transfer-employee');

/* Route for Pending Employee */
Route::get('/pending-transfer-dashboard','PendingTransferController@index')->name('pending-transfer');
Route::get('/pending-transfer-get-block', 'PendingTransferController@getPendingBlock')->name('pending-transfer-get-block');
Route::get('/pending-transfer-get-gp', 'PendingTransferController@getPendingGramPanchayat')->name('pending-transfer-get-gp');
Route::get('/pending-transfer-get-designation', 'PendingTransferController@getPendingDesignation')->name('pending-transfer-get-designation');
Route::get('/get-pending-employee-deatils', 'PendingTransferController@pendingEmployeeDetails')->name('get-pending-employee-deatils');



