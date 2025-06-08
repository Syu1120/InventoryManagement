<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Goods;
use App\Models\Goods_scheduled;
use App\Models\Goods_stock;
use App\Models\User;

class RegistrationController extends Controller
{
    // 入荷予定新規登録
    public function createScheduledForm() {

    }
    public function createScheduled() {

    }

    // 入荷予定編集
    public function editScheduledForm() {

    }
    public function editScheduled() {

    }

    // 在庫編集
    public function editStockForm() {

    }
    public function editStock() {

    }

    // 商品新規登録
    public function createGoodsForm() {
        return view('goods.goods_create');
    }
    public function createGoods(Request $request) {
        $input = $request->only(['name', 'weight']);
        $input['store_id'] = 1;
        $imageUrl = null;

        if ($request->hasfile('image')) {
            $path = $request->file('image')->store('temp', 'public');
            $input['image'] = $path;
            $imageUrl = asset('storage/' . $path);
        }

        $request->session()->put('goods_input_data', $input);

        return view('goods.goods_create_check', [
            'params' => $input,
            'image_url' => $imageUrl
        ]);
    }
    public function createGoodsComplete(Request $request) {
        $input = $request->session()->get('goods_input_data');
        $imagePath = null;

        if (!empty($input['image']) && Storage::disk('public')->exists($input['image'])) {
            $newPath = str_replace('temp/', 'images/', $input['image']);
            Storage::disk('public')->move($input['image'], $newPath);
            $imagePath = $newPath;
        }

        Goods::create([
            'store_id' => $input['store_id'],
            'name' => $input['name'],
            'weight' => $input['weight'],
            'image' => $imagePath
        ]);

        $request->session()->forget('goods_input_data');

        return redirect('/goods_list');
    }

    // 商品編集
    public function editGoodsForm() {

    }
    public function editGoods() {

    }

    // ユーザー新規登録
    public function createUserForm() {
        return view('users.user_create');
    }
    public function createUser(Request $request) {
        $input = $request->only(['name', 'email', 'password']);
        $input['store_id'] = 1;

        // 重すぎてpostしたときにタイムアウトしたためコメントアウトしています
        // $input['password'] = Hash::make($input['password']);

        // 0は管理,1は一般
        $input['role'] = 1;

        $request->session()->put('user_input_data', $input);

        return view('users.user_create_check', [
            'params' => $input,
        ]);
    }
    public function createUserComplete(Request $request) {
        $input = $request->session()->get('user_input_data');

        User::create($input);

        $request->session()->forget('user_input_data');

        return redirect('/user_list');
    }
}
