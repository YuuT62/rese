<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DevController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;

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


Route::get('/thanks',[DevController::class, 'thanks']);
Route::get('/done',[DevController::class, 'done']);

Route::middleware('auth')->group(function () {
    Route::get('/', [ShopController::class, 'index']);
    Route::post('/', [ShopController::class, 'favorite']);
    Route::get('/search', [ShopController::class, 'search']);
    Route::get('/detail/{shop_id}',[ShopController::class, 'detail']);

    Route::get('/mypage',[UserController::class, 'mypage']);
    Route::post('/mypage/favorite/true',[UserController::class, 'favorite_true']);
    Route::post('/mypage/favorite/false',[UserController::class, 'favorite_false']);

    Route::post('/reservation/add',[ReservationController::class, 'add']);
    Route::post('/reservation/delete',[ReservationController::class, 'delete']);
    Route::post('/reservation/change',[ReservationController::class, 'change']);
    Route::post('/reservation/edit',[ReservationController::class, 'edit']);
    Route::post('/reservation/update',[ReservationController::class, 'update']);
    Route::get('/done',[ReservationController::class, 'done']);

    Route::post('/reservation/evaluation', [ReservationController::class, 'evaluation']);
});
