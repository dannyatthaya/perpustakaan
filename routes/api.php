<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::patch('settings/profile', 'Settings\ProfileController@update');
    Route::patch('settings/password', 'Settings\PasswordController@update');

    Route::get('/buku/{id}', 'BooksController@show')->middleware('isAdminOrSelf');
    Route::post('/buku', 'BooksController@store')->middleware('isAdmin');
    Route::put('/buku/{id}', 'BooksController@update')->middleware('isAdmin');
    Route::delete('/buku/{id}', 'BooksController@delete')->middleware('isAdmin');

    Route::get('/anggota/{id}', 'MembersController@show')->middleware('isAdminOrSelf');
    Route::post('/anggota', 'MembersController@store')->middleware('isAdmin');
    Route::put('/anggota/{id}', 'MembersController@update')->middleware('isAdmin');
    Route::delete('/anggota/{id}', 'MembersController@delete')->middleware('isAdmin');

    Route::put('/pinjam/{id}', 'BorrowsController@update')->middleware('isAdmin');
    Route::delete('/pinjam/{id}', 'BorrowsController@delete')->middleware('isAdmin');

    Route::get('/kembali', 'ReturnsController@all')->middleware('isAdminOrSelf');
    Route::get('/kembali/{id}', 'ReturnsController@show')->middleware('isAdminOrSelf');
    Route::post('/kembali', 'ReturnsController@store')->middleware('isAdmin');
    Route::put('/kembali/{id}', 'ReturnsController@update')->middleware('isAdmin');
    Route::delete('/kembali/{id}', 'ReturnsController@delete')->middleware('isAdmin');
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');

    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('email/verify/{user}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend');

    Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
    Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');

    Route::post('/pinjam', 'BorrowsController@store');
    Route::get('/pinjam/{id}', 'BorrowsController@show');
});

Route::get('/buku', 'BooksController@all');

Route::get('/pinjam', 'BorrowsController@all');
Route::get('/pinjam/{id}', 'BorrowsController@show');
Route::get('/peminjaman', 'BorrowsController@showPerUser');
Route::post('/pinjam', 'BorrowsController@store');

Route::get('/buku/{id}', 'BooksController@show');
Route::get('/anggota', 'MembersController@all');
Route::get('/getuserid', function (Request $request) {
    return Auth::user()->id;
});