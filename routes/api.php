<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDataController;
use App\Http\Controllers\TypeUserController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\RegisterController;




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
// Route::get('sendbasicemail', [MailController::class, 'basic_email']);



Auth::routes(['verify' => true]);

Route::get('countries', [CountriesController::class, 'index']);
Route::get('countries/{id}', [CountriesController::class, 'filter']);

Route::post('register', 'App\Http\Controllers\UserController@register');
Route::post('login', 'App\Http\Controllers\UserController@authenticate');

Route::get('mail', [EmailController::class, 'mail']);
Route::post('send', [EmailController::class, 'create']);

Route::post('envio', [EmailController::class, 'enviar']);
Route::post('enviar-email', [EmailController::class, 'enviarEmail']);

Route::resource('user_data', UserDataController::class);
Route::delete('user_data/{id}', [UserDataController::class, 'destroy']);
Route::resource('type-user', TypeUserController::class);
Route::delete('delete_type-user/{id}', [TypeUserController::class, 'destroy']);
// Route::group(['middleware' => ['jwt.verify']], function() {

//     Route::post('user','App\Http\Controllers\UserController@getAuthUser');

// });
// Route::get('profile', function () {
//     // Only verified users may enter...
// })->middleware('verified');

Route::post('user','App\Http\Controllers\UserController@getAuthUser');

Route::get('users', [UserController::class, 'index']);
Route::post('registercomplet', [UserController::class, 'store']);
Route::get('users_show/{id}', [UserController::class, 'show']);
Route::put('usersup/{id}', [UserController::class, 'update']);
Route::delete('delete/{id}', [UserController::class, 'destroy']);

Route::group(['middleware' => ['api', 'auth.jwt']], function () {


    /**
     * |--------------------------------------------------------------------------
     * | User
     * |--------------------------------------------------------------------------
     *
     */




});
