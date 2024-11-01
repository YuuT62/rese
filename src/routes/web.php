<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\QRController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;

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

Route::middleware('verified')->group(function () {

    Route::get('/', [ShopController::class, 'index']);
    // Route::post('/', [ShopController::class, 'favorite']);
    Route::get('/search', [ShopController::class, 'search']);
    Route::get('/detail/{shop_id}',[ShopController::class, 'detail']);
    Route::get('/mypage',[UserController::class, 'mypage']);
    // Route::post('/mypage/favorite/true',[UserController::class, 'favoriteTrue']);
    // Route::post('/mypage/favorite/false',[UserController::class, 'favoriteFalse']);
    Route::post('/favorite',[ShopController::class, 'favorite'])->name('shop.favorite');
    Route::get('/thanks',[UserController::class, 'thanks']);
    Route::post('/reservation/add',[ReservationController::class, 'add']);
    Route::post('/reservation/delete',[ReservationController::class, 'delete']);
    Route::get('/reservation/edit',[ReservationController::class, 'edit']);
    Route::get('/reservation/update',[ReservationController::class, 'update']);
    Route::post('/reservation/update',[ReservationController::class, 'update']);
    Route::post('/reservation/evaluation', [ReservationController::class, 'evaluation']);
    Route::post('/reservation/evaluation/add', [ReservationController::class, 'evaluationAdd']);
    Route::get('/done',[ReservationController::class, 'done']);
    Route::post('/reservation/qr', [QRController::class, 'qrcode']);
    Route::get('/credit/confirm',[QRController::class, 'confirm']);
    Route::get('/credit{amount}',[PaymentController::class, 'credit']);
    Route::post('/payment',[PaymentController::class, 'payment']);


    Route::get('/sort',[ShopController::class, 'sort']);
});

// 管理者
Route::group(['middleware' => ['auth','can:admin']], function () {
    Route::get('/add',[ManagementController::class, 'add']);
    Route::post('/add',[ManagementController::class, 'create']);
    Route::get('/email',[ManagementController::class, 'email']);
    Route::post('/email',[ManagementController::class, 'send']);
});

// 店舗代表者
Route::group(['middleware' => ['auth','can:representative']], function () {
    Route::get('/management',[ManagementController::class, 'management']);
    Route::get('/shop/add',[ManagementController::class, 'addShop']);
    Route::post('/shop/add',[ManagementController::class, 'createShop']);
    Route::get('/edit/{shop_id}',[ManagementController::class, 'edit']);
    Route::post('/update',[ManagementController::class, 'update']);
    Route::get('/reservation_list/{shop_id}',[ManagementController::class, 'reservationList']);
    Route::get('/reservation_list/detail/{reservation_id}',[ManagementController::class, 'reservationDetail']);
    Route::get('/bill',[ManagementController::class, 'bill']);
    Route::post('/bill/qr',[ManagementController::class, 'billQR']);
    Route::get('/reservation/confirm',[QRController::class, 'confirm']);
    Route::post('/reservation/confirm',[QRController::class, 'visit']);
});

// 利用者
Route::group(['middleware' => ['auth','can:user']], function () {
    Route::get('/review{shop_id}',[ReviewController::class, 'review']);
    Route::post('/review/send' ,[ReviewController::class, 'reviewSend']);
    Route::post('review/delete',[ReviewController::class, 'reviewDelete']);
});