<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Goods;
use App\Models\Goods_scheduled;
use App\Models\Goods_stock;
use App\Models\User;
use App\Models\Store;

class SoftDeleteController extends Controller
{
    public function deleteStock($id) {
        $stock = Goods_stock::findOrFail($id);
        $stock->delete();
        return response()->json(['message' => '削除しました']);
    }

    public function deleteScheduled($id) {
        $scheduled = Goods_scheduled::findOrFail($id);
        $scheduled->delete();
        return response()->json(['message' => '削除しました']);
    }

    public function deleteGoods($id) {
        $goods = Goods::findOrFail($id);
        $goods->delete();
        return response()->json(['message' => '削除しました']);
    }

    public function deleteUser($id) {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => '削除しました']);
    }
}
