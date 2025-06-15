<!-- 商品情報編集フォーム -->

@extends('layouts.app')
@section('content')
<main class="py-4">
    <div class="col-md-5 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class='text-center'>商品編集</h1>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <form action="{{ route('edit.goods', ['id' => $goods->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <lavel for='image'>画像</lavel>
                        {{-- 現在の画像を表示 --}}
                            @if ($goods->image)
                                <div class="mb-2">
                                    <p>現在の画像：</p>
                                    <img src="{{ asset('storage/' . $goods->image) }}" alt="現在の画像" width="150">
                                </div>
                            @endif
                        {{-- 画像ファイルの再アップロード --}}
                            <input type="file" class="form-control" name="image" id="image">

                        <label for='name'>商品名</label>
                            <input type='text' class='form-control' name='name' value="{{ $goods->name }}"/>
                        <label for='weight'>重量</label>
                            <input type='text' class='form-control' name='weight' value="{{ $goods->weight }}"/>
                        <div class='row justify-content-center'>
                            <button type='submit' class='btn btn-primary w-25 mt-3'>登録</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
