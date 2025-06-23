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
        $role = Auth::user()->role;
        return view('home',
            ['role' => $role]
        );
    }

    // 在庫一覧画面表示(自店舗)
    public function stockList() {
        $stocks = Goods_stock::with('goods')->where('store_id', Auth::user()->store_id)->get();

        return view('goods_stocks.goods_stock_list',
            ['stocks' => $stocks]
        );
    }
    // 在庫一覧画面表示(他店舗)
    public function stockOtherStoreList(int $id) {
        $stocks = Goods_stock::with('goods')->where('store_id', $id)->get();

        if (is_null($stocks)) {
            abort(404);
        }

        return view('goods_stocks.goods_stock_all_list',
            ['stocks' => $stocks]
        );
    }
    // 在庫検索表示(自店舗)
    public function searchStock(Request $request) {
        $query = Goods_stock::with('goods')->where('store_id', Auth::user()->store_id);

        // 商品名で部分一致検索（リレーション先の name）
        if ($request->filled('goods_name')) {
            $query->whereHas('goods', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->goods_name . '%');
            });
        }

        // 入荷予定日などで検索（例：date）
        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        $stocks = $query->get();

        return view('goods_stocks.goods_stock_list', [
            'stocks' => $stocks,
        ]);
    }
    // 在庫検索表示(他店舗)
    public function searchAllStock(Request $request) {
        $query = Goods_stock::with('goods');

        // 商品名で部分一致検索（リレーション先の name）
        if ($request->filled('goods_name')) {
            $query->whereHas('goods', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->goods_name . '%');
            });
        }

        // 入荷予定日などで検索（例：date）
        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        // 店舗名で部分一致検索（リレーション先の name）
        if ($request->filled('store_name')) {
            $storeIds = Store::where('name', 'like', '%' . $request->store_name . '%')->pluck('id');

            $query->whereIn('store_id', $storeIds);
        }

        $stocks = $query->get();

        return view('goods_stocks.goods_stock_all_list', [
            'stocks' => $stocks,
        ]);
    }

    // 入荷予定一覧画面表示
    public function scheduledList() {
        // $scheduleds = Goods_scheduled::with('goods')->where('store_id', 1)->get();
        $scheduleds = Goods_scheduled::with('goods')->where('store_id', Auth::user()->store_id)->get();

        return view('goods_scheduled.goods_scheduled_list',
            ['scheduleds' => $scheduleds]
        );
    }
    // 入荷予定検索表示
    public function searchScheduled(Request $request) {
        $query = Goods_scheduled::with('goods')->where('store_id', Auth::user()->store_id);

        // 商品名で部分一致検索（リレーション先の name）
        if ($request->filled('goods_name')) {
            $query->whereHas('goods', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->goods_name . '%');
            });
        }

        // 入荷予定日などで検索（例：date）
        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        $scheduleds = $query->get();

        return view('goods_scheduled.goods_scheduled_list', [
            'scheduleds' => $scheduleds,
        ]);
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
    // 商品情報検索表示
    public function searchGoods(Request $request) {
        $query = Goods::where('store_id', Auth::user()->store_id);

        // 商品名で部分一致検索（リレーション先の name）
        if ($request->filled('goods_name')) {
            $query->where('name', 'like', '%' . $request->goods_name . '%');
        }

        $goods = $query->get();

        return view('goods.goods_list', [
            'allGoods' => $goods,
        ]);
    }

    // ユーザー一覧画面表示
    public function userList() {
        $users = User::where('store_id', Auth::user()->store_id)->get();

        return view('users.user_list',
            ['users' => $users]
        );
    }
    // ユーザー検索表示
    public function searchUser(Request $request) {
        $query = User::where('store_id', Auth::user()->store_id);

        // 商品名で部分一致検索（リレーション先の name）
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $users = $query->get();

        return view('users.user_list', [
            'users' => $users,
        ]);
    }
}
