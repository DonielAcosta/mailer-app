<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDataController;
use App\Http\Controllers\TypeUserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EmailController;





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
// Route::get('hola','EmailController@hola');
Route::get('mail', [EmailController::class, 'mail']);
Route::post('send', [EmailController::class, 'create']);

Route::get('sendbasicemail', [EmailController::class, 'basic_email']);


// Route::get('sendbasicemail','MailController@basic_email');
Route::get('sendhtmlemail','MailController@html_email');
Route::get('sendattachmentemail','MailController@attachment_email');


Route::get('users', [UserController::class, 'index']);
Route::post('register', [UserController::class, 'store']);
Route::get('users_show/{id}', [UserController::class, 'show']);
Route::put('usersup/{id}', [UserController::class, 'update']);
Route::delete('delete_user/{id}', [UserController::class, 'destroy']);

Route::resource('user_data', UserDataController::class);
Route::post('register-basico', [RegisterController::class, 'signUp']);
Route::resource('type-user', TypeUserController::class);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
