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

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/alman2', 'HomeController@alman2');
Route::get('/alman4', 'HomeController@alman4');
Route::get('/almanm', 'HomeController@almanm');
Route::get('/almanp', 'HomeController@almanp');
Route::get('/printscanedp', 'HomeController@printscanedp');
Route::get('/printscaned4', 'HomeController@printscaned4');
Route::get('/printscanedm', 'HomeController@printscanedm');
Route::get('/printscaned2', 'HomeController@printscaned2');


Auth::routes(['register' => false, 'reset' => true]);
Route::get('/', 'HomeController@index')->name('home');
Route::get('/cron', 'cron@qrcode');
Route::get('/coba', 'cron@cektiket');

Route::get('/logout', 'cron@logout')->name('logout');
Route::get('/logalman', 'HomeController@logalman');

Route::get('/login', 'cron@login')->name('login');
Route::get('/home', 'HomeController@index');
Route::get('/karcis', 'HomeController@karcis');
Route::get('/profil', 'HomeController@profil');

Route::get('/sukses', 'HomeController@sukses');

Route::get('/pengunjung', 'HomeController@pengunjung');
Route::get('/user', 'HomeController@user');
Route::get('/datakunjungan', 'HomeController@datakunjungan');
Route::get('tabelkunload', 'HomeController@loadtabelkun')->name('ajax.load.tabelkunjungan');
Route::get('tabelkarcisload', 'HomeController@loadtabelkarcis')->name('ajax.load.tabelkarcis');


Route::post('/updatepass', 'HomeController@updatepass');
Route::post('/updatepassa', 'HomeController@updatepassa');



Route::get('/r/{kodearcis}', 'HomeController@postvisitor');
Route::get('/dlroda2', 'HomeController@dlroda2');
Route::get('/dlroda4', 'HomeController@dlroda4');
Route::get('/dlpejalan', 'HomeController@dlpejalan');
Route::get('/dlmancanegara', 'HomeController@dlmancanegara');


Route::get('tabelvisload', 'HomeController@loadtabelvis')->name('ajax.load.tabelvis');

Route::post('/posthapuskarcis', 'HomeController@posthapuskarcis');
Route::post('/postupdatekarcis', 'HomeController@postupdatekarcis');
Route::post('/posthapususer', 'HomeController@posthapususer');
Route::post('/postupdateuser', 'HomeController@postupdateuser');
Route::post('/postaddkode', 'HomeController@postaddkode');
Route::post('/posthapuskodekarcis', 'HomeController@posthapuskodekarcis');

Route::get('datakarcis', 'HomeController@datakarcis');
Route::post('/postadduser', 'HomeController@postadduser');

Route::post('/posthapuskunjungan', 'HomeController@posthapuskunjungan');

Route::post('/printvisitor', 'HomeController@printvisitor');


Route::get('masuk/{link}', 'cron@masuk');
Route::post('getjenis', 'cron@getjenis')->name('getjenis');
Route::post('getjumlah', 'cron@getjumlah')->name('getjumlah');
Route::post('postkirim', 'cron@postkirim')->name('postkirim');
