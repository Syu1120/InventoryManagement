<!-- 商品情報編集確認 -->

@extends('layouts.app')
@section('content')
<main class="py-4">
    <div class="col-md-5 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class='text-center'>商品編集確認</h1>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <form action="{{ route('edit.goods.check', ['id' => $id])}}" method="post">
                        @csrf

                        <label for='name'>画像</label>
                            <div>
                                @if (!empty($edit_input['tmp_image']))
                                    <img src="{{ asset('storage/' . $edit_input['tmp_image']) }}" width="200" alt="{{ $edit_input['name'] }}">
                                @else
                                    <img src="{{ asset('storage/' . $edit_input['image']) }}" width="200" alt="{{ $edit_input['name'] }}">
                                @endif
                            </div>

                        <label for='name'>商品名</label>
                            <div>
                                {{ $edit_input['name'] }}
                            </div>
                        <label for='weight'>重量</label>
                            <div>
                                {{ $edit_input['weight'] }}
                            </div>
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

