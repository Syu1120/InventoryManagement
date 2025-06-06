<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DisplayController::class, 'index']);

Route::get('/home', [DisplayController::class, 'index'])->name('home');


// 在庫一覧
Route::get('/goods_stock_list', [DisplayController::class, 'stockList'])->name('stockList');
// 入荷予定一覧
Route::get('/goods_scheduled_list', [DisplayController::class, 'scheduledList'])->name('scheduledList');
// 入荷予定新規登録フォーム
Route::get('/goods_scheduled_list/create', [RegistrationController::class, 'createScheduledForm'])->name('create.scheduled');
Route::post('/goods_scheduled_list/create', [RegistrationController::class, 'createScheduled']);
// 入荷予定編集フォーム
Route::get('/goods_scheduled_list/edit', [RegistrationController::class, 'editScheduledForm'])->name('edit.scheduled');
Route::post('/goods_scheduled_list/edit', [RegistrationController::class, 'editScheduled']);
// 在庫情報編集フォーム
Route::get('/goods_stock_list/edit', [RegistrationController::class, 'editStockForm'])->name('edit.stock');
Route::post('/goods_stock_list/edit', [RegistrationController::class, 'editStock']);


// 他店舗一覧
Route::get('/store_list', [DisplayController::class, 'storeList'])->name('storeList');


// 商品情報一覧
Route::get('/goods_list', [DisplayController::class, 'goodsList'])->name('goodsList');
// 商品新規登録フォーム
Route::get('/goods_list/create', [RegistrationController::class, 'createGoodsForm'])->name('create.goods');
Route::post('/goods_list/create', [RegistrationController::class, 'createGoods']);
// 商品情報編集フォーム
Route::get('/goods_list/edit', [RegistrationController::class, 'editGoodsForm'])->name('edit.goods');
Route::post('/goods_list/edit', [RegistrationController::class, 'editGoods']);


// ユーザー一覧
Route::get('/user_list', [DisplayController::class, 'userList'])->name('userList');
// ユーザー新規登録フォーム
Route::get('/user_list/create', [RegistrationController::class, 'createUserForm'])->name('create.user');
Route::post('/user_list/create', [RegistrationController::class, 'createUser']);