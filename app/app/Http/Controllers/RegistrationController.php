<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Goods;
use App\Models\Goods_scheduled;
use App\Models\Goods_stock;
use App\Models\User;
use App\Models\Store;

class RegistrationController extends Controller
{
    // 入荷予定新規登録(get)
    public function createScheduledForm() {
        $params = Goods::where('store_id', Auth::user()->store_id)->get();

        return view('goods_scheduled.goods_scheduled_create',
            ['allGoods' => $params]
        );
    }
    // 入荷予定新規登録(post)
    public function createScheduled(Request $request) {
        $goods = Goods::findOrFail($request['name']);

        $input = $request->only(['quantity', 'date']);
        $input['store_id'] = Auth::user()->store_id;
        $input['goods_id'] = $goods->id;
        $input['weight']   = $goods->weight * $input['quantity'];

        $goods_name = Goods::find($input['goods_id'])->name;

        $request->session()->put('scheduled_input_data', $input);

        return view('goods_scheduled.goods_scheduled_create_check',
            ['params'     => $input],
            ['goods_name' => $goods_name]
        );
    }
    // 入荷予定新規登録確認(post)
    public function createScheduledComplete(Request $request) {
        $input = $request->session()->get('scheduled_input_data');

        Goods_scheduled::create($input);

        $request->session()->forget('scheduled_input_data');

        return redirect('/goods_scheduled_list');
    }

    // 入荷予定編集(get)
    public function editScheduledForm(int $id) {
        $scheduled = Goods_scheduled::findOrFail($id);

        return view('goods_scheduled.goods_scheduled_edit',
            ['scheduled' => $scheduled]
        );
    }
    // 入荷予定編集(post)
    public function editScheduled(int $id, Request $request) {
        $scheduled = Goods_scheduled::findOrFail($id);

        $input = [
            'quantity' => $request->filled('quantity') ? $request->input('quantity') : $scheduled->quantity,
            'date'     => $request->filled('date')     ? $request->input('date')     : $scheduled->date
        ];

        $request->session()->put('goods_scheduled_edit_input_data', $input);

        return view('goods_scheduled.goods_scheduled_edit_check',[
            'id' => $id,
            'edit_input' => $request->session()->get('goods_scheduled_edit_input_data')
        ]);
    }
    // 入荷予定編集確認(post)
    public function editScheduledComplete(int $id, Request $request) {
        $edit_input = $request->session()->get('goods_scheduled_edit_input_data');
        $scheduled = Goods_scheduled::findOrFail($id);

        $scheduled->quantity   = $edit_input['quantity'];
        $scheduled->date       = $edit_input['date'];

        $scheduled->save();

        $request->session()->forget('goods_scheduled_edit_input_data');

        return redirect('/goods_scheduled_list');
    }

    // 入荷確定(post)
    public function addToStock($id) {
        $scheduled = Goods_scheduled::with('goods')->findOrFail($id);

        $stock = Goods_stock::where('store_id', Auth::user()->store_id)->where('goods_id', $scheduled->goods_id)->first();

        if (!$stock) {
            $stock = new Goods_stock();
            $stock->goods_id = $scheduled->goods_id;
            $stock->store_id = Auth::user()->store_id;
            $stock->quantity = 0;
            $stock->weight = 0;
        }

        $stock->quantity += $scheduled->quantity;
        $stock->weight   += $scheduled->weight;
        $stock->date      = $scheduled->date;

        $stock->save();

        $scheduled->delete();

        return response()->json(['message' => '在庫に追加しました']);
    }

    // 在庫編集(get)
    public function editStockForm(int $id) {
        $stock = Goods_stock::findOrFail($id);

        return view('goods_stocks.goods_stock_edit',
            ['stock' => $stock]
        );
    }
    // 在庫編集(post)
    public function editStock(int $id, Request $request) {
        $stock = Goods_stock::findOrFail($id);

        $input = [
            'quantity' => $request->filled('quantity') ? $request->input('quantity') : $stock->quantity
        ];

        $request->session()->put('goods_stock_edit_input_data', $input);

        return view('goods_stocks.goods_stock_edit_check',[
            'id' => $id,
            'edit_input' => $request->session()->get('goods_stock_edit_input_data')
        ]);
    }
    // 在庫編集確認(post)
    public function editStockComplete(int $id, Request $request) {
        $edit_input = $request->session()->get('goods_stock_edit_input_data');
        $stock = Goods_stock::findOrFail($id);

        $stock->quantity = $edit_input['quantity'];

        $stock->save();

        $request->session()->forget('goods_stock_edit_input_data');

        return redirect('/goods_stock_list');
    }

    // 商品新規登録(get)
    public function createGoodsForm() {
        return view('goods.goods_create');
    }
    // 商品新規登録(post)
    public function createGoods(Request $request) {
        $input = $request->only(['name', 'weight']);
        $input['store_id'] = Auth::user()->store_id;
        $imageUrl = null;

        if ($request->hasfile('image')) {
            $path = $request->file('image')->store('temp', 'public');
            $input['image'] = $path;
            $imageUrl = asset('storage/' . $path);
        }

        $request->session()->put('goods_input_data', $input);

        return view('goods.goods_create_check',
            ['params'    => $input],
            ['image_url' => $imageUrl]
        );
    }
    // 商品新規登録確認(post)
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
            'name'     => $input['name'],
            'weight'   => $input['weight'],
            'image'    => $imagePath
        ]);

        $request->session()->forget('goods_input_data');

        return redirect('/goods_list');
    }

    // 商品編集(get)
    public function editGoodsForm(int $id) {
        $goods = Goods::findOrFail($id);

        return view('goods.goods_edit',
            ['goods' => $goods]
        );
    }
    // 商品編集(post)
    public function editGoods(int $id, Request $request) {
        $goods = Goods::findOrFail($id);

        $input = [
            'name'   => $request->filled('name')   ? $request->input('name')   : $goods->name,
            'weight' => $request->filled('weight') ? $request->input('weight') : $goods->weight,
            'image'  => $goods->image,
            'tmp_image' => null
        ];

        if ($request->hasFile('image')) {
            $tmpPath = $request->file('image')->store('temp', 'public');
            $input['tmp_image'] = $tmpPath;
        }

        $request->session()->put('goods_edit_input_data', $input);

        return view('goods.goods_edit_check',[
            'id' => $id,
            'edit_input' => $request->session()->get('goods_edit_input_data')
        ]);
    }
    // 商品編集確認(post)
    public function editGoodsComplete(int $id, Request $request) {
        $edit_input = $request->session()->get('goods_edit_input_data');
        $goods = Goods::findOrFail($id);

        $goods->name   = $edit_input['name'];
        $goods->weight = $edit_input['weight'];

        if (!empty($edit_input['tmp_image'])) {
            $tmpPath = storage_path('app/public/' . $edit_input['tmp_image']);
            $newPath = 'images/' . basename($edit_input['tmp_image']);

            if (file_exists($tmpPath)) {
                \Storage::disk('public')->move($edit_input['tmp_image'], $newPath);
                \Storage::disk('public')->delete($edit_input['tmp_image']);
                $goods->image = $newPath;
            }
            else {
                $goods->image = $edit_input['image'];
            }
        }
        else {
            $goods->image = $edit_input['image'];
        }

        $goods->save();

        $request->session()->forget('goods_edit_input_data');

        $stock = Goods_stock::with('goods')->where('store_id', Auth::user()->store_id)->where('goods_id', $goods->id)->first();

        if ($stock) {
            $stock->weight = $goods->weight * $stock->quantity;
            $stock->save();
        }

        $scheduleds = Goods_scheduled::with('goods')->where('store_id', Auth::user()->store_id)->where('goods_id', $goods->id)->get();

        if ($scheduleds->isNotEmpty()) {
            foreach ($scheduleds as $scheduled) {
                $scheduled->weight = $goods->weight * $scheduled->quantity;
                $scheduled->save();
            }
        }

        return redirect('/goods_list');
    }

    // ユーザー新規登録(get)
    public function createUserForm() {
        return view('users.user_create');
    }
    // ユーザー新規登録(post)
    public function createUser(Request $request) {
        $input = $request->only(['name', 'email', 'password']);
        $input['store_id'] = Auth::user()->store_id;

        $input['password'] = Hash::make($input['password']);

        $request->session()->put('user_input_data', $input);

        return view('users.user_create_check',
            ['params' => $input]
        );
    }
    // ユーザー新規登録確認(post)
    public function createUserComplete(Request $request) {
        $input = $request->session()->get('user_input_data');

        User::create($input);

        $request->session()->forget('user_input_data');

        return redirect('/user_list');
    }

    // 店舗新規登録時ユーザー新規登録(post)
    public function createNewStoreUser(int $store_id, Request $request) {
        $input = $request->only(['name', 'email', 'password']);
        $input['store_id'] = $store_id;
        $input['role'] = 0;

        $input['password'] = Hash::make($input['password']);

        $request->session()->put('user_input_data', $input);

        return view('users.user_create_check',
            ['params' => $input]
        );
    }
    // 店舗新規登録時ユーザー新規登録確認(post)
    public function createNewStoreUserComplete(Request $request) {
        $input = $request->session()->get('user_input_data');

        User::create($input);

        $request->session()->forget('user_input_data');

        return redirect('/store_list');
    }

    // 店舗新規登録(get)
    public function createStoreForm() {
        return view('stores.store_create');
    }
    // 店舗新規登録(post)
    public function createStore(Request $request) {
        $input = $request->only(['name']);

        $request->session()->put('store_input_data', $input);

        return view('stores.store_create_check',
            ['params' => $input]
        );
    }
    // 店舗新規登録確認(post)
    public function createStoreComplete(Request $request) {
        $input = $request->session()->get('store_input_data');

        $store = Store::create($input);

        $request->session()->forget('store_input_data');

        // 新店舗の管理者作成用にidを渡す
        $store_id = $store->id;

        return view('users.user_create_new_store',
            ['store_id' => $store_id]
        );
    }
}
