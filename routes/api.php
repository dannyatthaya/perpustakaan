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

    Route::get('/buku', 'BukuController@all')->middleware('isAdminOrSelf');
    Route::get('/buku/{id}', 'BukuController@show')->middleware('isAdminOrSelf');
    Route::post('/buku', 'BukuController@store')->middleware('isAdmin');
    Route::put('/buku/{id}', 'BukuController@update')->middleware('isAdmin');
    Route::delete('/buku/{id}', 'BukuController@delete')->middleware('isAdmin');

    Route::get('/anggota', 'AnggotaController@all')->middleware('isAdminOrSelf');
    Route::get('/anggota/{id}', 'AnggotaController@show')->middleware('isAdminOrSelf');
    Route::post('/anggota', 'AnggotaController@store')->middleware('isAdmin');
    Route::put('/anggota/{id}', 'AnggotaController@update')->middleware('isAdmin');
    Route::delete('/anggota/{id}', 'AnggotaController@delete')->middleware('isAdmin');

    Route::get('/pinjam', 'PeminjamanController@all')->middleware('isAdminOrSelf');
    Route::get('/pinjam/{id}', 'PeminjamanController@show');
    Route::post('/pinjam', 'PeminjamanController@store');
    Route::put('/pinjam/{id}', 'PeminjamanController@update')->middleware('isAdmin');
    Route::delete('/pinjam/{id}', 'PeminjamanController@delete')->middleware('isAdmin');

    Route::get('/kembali', 'PengembalianController@all')->middleware('isAdminOrSelf');
    Route::get('/kembali/{id}', 'PengembalianController@show')->middleware('isAdminOrSelf');
    Route::post('/kembali', 'PengembalianController@store')->middleware('isAdmin');
    Route::put('/kembali/{id}', 'PengembalianController@update')->middleware('isAdmin');
    Route::delete('/kembali/{id}', 'PengembalianController@delete')->middleware('isAdmin');
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

    Route::get('/buku', 'BukuController@all');
    Route::get('/buku/{id}', 'BukuController@show');
    Route::post('/pinjam', 'PeminjamanController@store');
    Route::get('/pinjam/{id}', 'PeminjamanController@show');
});