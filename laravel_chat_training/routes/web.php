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

    Route::get('delete-message/{id}', 'MassageController@destroy')->name('message.delete');
    Route::post('message-store','MassageController@store' )->name('message.store');

    Route::get('/friends', 'FriendController@index')->name('freinds');
    Route::get('unfriend/{id}', 'FriendController@destroy')->name('unfriend');
    Route::get('add-firend', 'FriendController@create')->name('add.firend');
    Route::post('search-friend','FriendController@search' )->name('search.friend');
    Route::post('accept-friend','FriendController@store' )->name('accept.friend');
    Route::get('request-friend/{id}','FreindRequestController@store' )->name('request.friend');

    Route::get('message-friend/{id}','FreindChatController@show' )->name('message.friend');
    Route::post('message-store-friend-chat','FreindChatController@store' )->name('message.store.friend.chat');
});

