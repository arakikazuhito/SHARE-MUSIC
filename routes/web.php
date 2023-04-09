<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\CommentController;
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

Route::controller(MusicController::class)->group(function () {
    Route::get('/', 'top')->name('top');
    Route::get('serch', 'serch')->name('serch');
    Route::get('/music_detail/{id}/{user_id}', 'music_detail')->name('music_detail');
    Route::get('/post', 'post')->name('post')->middleware('auth');
    Route::post('/confirm', 'confirm')->name('confirm')->middleware('auth');
    Route::post('/complete', 'complete')->name('complete')->middleware('auth');
    Route::post('/like', 'like')->name('like');
});
Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/logincomplete', 'logincomplete')->name('logincomplete');
    Route::get('/passwordreset', 'passwordreset')->name('passwordreset');
    Route::get('/signup', 'signup')->name('signup');
    Route::post('/register', 'register')->name('register');
    Route::get('/logout', 'logout')->name('logout');
    Route::get('/user_detail', 'user_detail')->name('user_detail')->middleware('auth');
    Route::get('/user_detail/edit', 'edit')->name('edit')->middleware('auth');
    Route::post('/edit_complete', 'edit_complete')->name('edit_complete')->middleware('auth');
    Route::get('/other_user/{id}', 'other_user')->name('other_user');
});

Route::controller(CommentController::class)->group(function () {
    Route::post('/comment', 'comment')->name('comment')->middleware('auth');
    Route::post('/commentreplay', 'commentreplay')->name('commentreplay')->middleware('auth');
});

Route::controller(PasswordController::class)->group(function () {
    Route::get('/password_reset', 'password_reset')->name('password_reset');
    Route::post('/password_reset', 'send_email')->name('send_email');
    Route::get('/send_complete', 'send_complete')->name('send_complete');
    Route::get('/password_edit', 'password_edit')->name('password_edit');
    Route::post('/password_update', 'password_update')->name('password_update');
    Route::get('/password_update_complete', 'password_update_complete')->name('password_update_complete');
});
