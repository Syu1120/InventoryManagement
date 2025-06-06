<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goods;
use App\Models\Goods_scheduled;
use App\Models\Goods_stock;

class DisplayController extends Controller
{
    public function index() {
        return view('home');
    }

    // 在庫一覧画面表示
    public function stockList() {
        return view('goods_stocks.goods_stock_list');
    }

    // 入荷予定一覧画面表示
    public function scheduledList() {
        return view('goods_scheduled.goods_scheduled_list');
    }

    // 他店舗一覧画面表示
    public function storeList() {
        return view('stores.store_list');
    }

    // 商品情報一覧画面表示
    public function goodsList() {
        return view('goods.goods_list');
    }

    // ユーザー一覧画面表示
    public function userList() {
        return view('users.user_list');
    }
}
