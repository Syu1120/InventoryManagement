<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SoftDeleteController;
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

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get( '/', [DisplayController::class, 'index'])->name('home');


    // 在庫一覧
    Route::get( '/goods_stock_list', [DisplayController::class, 'stockList'])->name('stockList');
    // 在庫一覧(他店舗)
    Route::get( '/goods_stock_list/other_store/{id}', [DisplayController::class, 'stockOtherStoreList'])->name('stockOtherStoreList');
    // 在庫検索
    Route::get( '/goods_stock_list/search', [DisplayController::class, 'searchStock'])->name('search.stock');
    // 在庫検索(他店舗＋自店舗)
    Route::get( '/goods_stock_list/all_store/search', [DisplayController::class, 'searchAllStock'])->name('search.all.stock');
    // 在庫情報編集フォーム
    Route::get( '/goods_stock_list/{id}/edit',       [RegistrationController::class, 'editStockForm'])    ->name('edit.stock');
    Route::post('/goods_stock_list/{id}/edit',       [RegistrationController::class, 'editStock']);
    Route::post('/goods_stock_list/{id}/edit/check', [RegistrationController::class, 'editStockComplete'])->name('edit.stock.check');
    // 在庫情報削除
    Route::delete('/goods_stock/{id}/delete', [SoftDeleteController::class, 'deleteStock']);
    // 入荷予定一覧
    Route::get( '/goods_scheduled_list', [DisplayController::class, 'scheduledList'])->name('scheduledList');
    // 入荷予定検索
    Route::get( '/goods_scheduled_list/search', [DisplayController::class, 'searchScheduled'])->name('search.scheduled');
    // 入荷予定新規登録フォーム
    Route::get( '/goods_scheduled_list/create',       [RegistrationController::class, 'createScheduledForm'])    ->name('create.scheduled.form');
    Route::post('/goods_scheduled_list/create',       [RegistrationController::class, 'createScheduled'])        ->name('create.scheduled');
    Route::post('/goods_scheduled_list/create/check', [RegistrationController::class, 'createScheduledComplete'])->name('create.scheduled.check');
    // 入荷予定編集フォーム
    Route::get( '/goods_scheduled_list/{id}/edit',       [RegistrationController::class, 'editScheduledForm'])    ->name('edit.scheduled');
    Route::post('/goods_scheduled_list/{id}/edit',       [RegistrationController::class, 'editScheduled']);
    Route::post('/goods_scheduled_list/{id}/edit/check', [RegistrationController::class, 'editScheduledComplete'])->name('edit.scheduled.check');
    // 入荷予定削除
    Route::delete('/goods_scheduled/{id}/delete', [SoftDeleteController::class, 'deleteScheduled']);
    // 入荷確定
    Route::post('/goods_scheduled/add_to_stock/{id}', [RegistrationController::class, 'addToStock'])->name('scheduled.addToStock');


    // 他店舗一覧
    Route::get( '/store_list', [DisplayController::class, 'storeList'])->name('storeList');
    // 店舗新規登録フォーム
    Route::get( '/store/create',       [RegistrationController::class, 'createStoreForm'])    ->name('create.store');
    Route::post('/store/create',       [RegistrationController::class, 'createStore']);
    Route::post('/store/create/check', [RegistrationController::class, 'createStoreComplete'])->name('create.store.check');


    // 商品情報一覧
    Route::get( '/goods_list', [DisplayController::class, 'goodsList'])->name('goodsList');
    // 商品情報検索
    Route::get( '/goods_list/search', [DisplayController::class, 'searchGoods'])->name('search.goods');
    // 商品新規登録フォーム
    Route::get( '/goods_list/create',       [RegistrationController::class, 'createGoodsForm'])    ->name('create.goods');
    Route::post('/goods_list/create',       [RegistrationController::class, 'createGoods']);
    Route::post('/goods_list/create/check', [RegistrationController::class, 'createGoodsComplete'])->name('create.goods.check');
    // 商品情報編集フォーム
    Route::get( '/goods_list/{id}/edit', [RegistrationController::class, 'editGoodsForm'])->name('edit.goods');
    Route::post('/goods_list/{id}/edit', [RegistrationController::class, 'editGoods']);
    Route::post('/goods_list/{id}/edit/check', [RegistrationController::class, 'editGoodsComplete'])->name('edit.goods.check');
    // 商品情報削除
    Route::delete('/goods/{id}/delete', [SoftDeleteController::class, 'deleteGoods']);


    // ユーザー一覧
    Route::get( '/user_list', [DisplayController::class, 'userList'])->name('userList');
    // ユーザー検索
    Route::get( '/user_list/search', [DisplayController::class, 'searchUser'])->name('search.user');
    // ユーザー新規登録フォーム
    Route::get( '/user_list/create',       [RegistrationController::class, 'createUserForm'])    ->name('create.user');
    Route::post('/user_list/create',       [RegistrationController::class, 'createUser']);
    Route::post('/user_list/create/check', [RegistrationController::class, 'createUserComplete'])->name('create.user.check');
    // ユーザー新規登録(店舗追加時)フォーム
    Route::post('/user/{id}/create',       [RegistrationController::class, 'createNewStoreUser'])        ->name('create.newStore.user');
    Route::post('/user/{id}/create/check', [RegistrationController::class, 'createNewStoreUserComplete'])->name('create.newStore.user.check');
    // ユーザー情報削除
    Route::delete('/user/{id}/delete', [SoftDeleteController::class, 'deleteUser']);

    Route::post('/users/{id}/send-reset-mail', 'RegistrationController@sendResetPasswordEmail');
});

Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');
