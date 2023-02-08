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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::middleware(['auth'])->group(function () {
   
    Route::get('send-email/', 'emailController@index');
    
    Route::post('send-email-method','emailController@sendEmail' )->name('send.email');
    Route::get('/home', 'ChatController@index')->name('home');

    Route::post('chat-store','ChatController@store' )->name('chat.store');
    Route::get('create-chat/', 'ChatController@create')->name('create.chat');
    Route::get('show-chat/{id}', 'ChatController@show')->name('chat.show');
    Route::put('update-chat/{id}', 'ChatController@update')->name('chat.update');
    Route::get('delete-chat/{id}', 'ChatController@destroy')->name('chat.delete');
});

