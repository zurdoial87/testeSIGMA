<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\UserController;

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

Route::group(['middleware' => ['auth']], function () {

Route::get('/' , [UserController::class, 'index'] )->name("user.index");
Route::get('/all_users' , [UserController::class, 'getAll'] )->name("user.getall");
Route::post('/save_user' , [UserController::class, 'store'] )->name("save.user");
Route::get('/get_user/{user}' , [UserController::class, 'show'] )->name("show.user");
Route::put('/update_user' , [UserController::class, 'update'] )->name("update.user");
Route::delete('/delete_user/{id}' , [UserController::class, 'destroy'] )->name("delete.user");
Route::get('/logout2' , [UserController::class, 'logout'] )->name("user.logout"); 


});

 




