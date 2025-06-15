<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goods;
use App\Models\Goods_scheduled;
use App\Models\Goods_stock;
use App\Models\User;
use App\Models\Store;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DisplayController extends Controller
{
    public function index() {
        return view('home');
    }

    // 在庫一覧画面表示
    public function stockList() {
        // $stocks = Goods_stock::with('goods')->where('store_id', 1)->get();
        $stocks = Goods_stock::with('goods')->where('store_id', Auth::user()->store_id)->get();

        return view('goods_stocks.goods_stock_list',
        ['stocks' => $stocks]
        );
    }

    // 入荷予定一覧画面表示
    public function scheduledList() {
        // $scheduleds = Goods_scheduled::with('goods')->where('store_id', 1)->get();
        $scheduleds = Goods_scheduled::with('goods')->where('store_id', Auth::user()->store_id)->get();

        return view('goods_scheduled.goods_scheduled_list',
        ['scheduleds' => $scheduleds]
        );
    }

    // 他店舗一覧画面表示
    public function storeList() {
        // $stores = Store::where('id', '!=', 1)->get();
        $stores = Store::where('id', '!=', Auth::user()->store_id)->get();

        return view('stores.store_list',
        ['stores' => $stores]
        );
    }

    // 商品情報一覧画面表示
    public function goodsList() {
        // $goods = Goods::where('store_id', 1)->get();
        $goods = Goods::where('store_id', Auth::user()->store_id)->get();

        return view('goods.goods_list',
        ['allGoods' => $goods]
        );
    }

    // ユーザー一覧画面表示
    public function userList() {
        // $users = User::where('store_id', 1)->get();
        $users = User::where('store_id', Auth::user()->store_id)->get();

        return view('users.user_list',
        ['users' => $users]
        );
    }
}
