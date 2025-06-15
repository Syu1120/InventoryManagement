<!-- 入荷予定新規登録確認 -->

@extends('layouts.app')
@section('content')
<main class="py-4">
    <div class="col-md-5 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class='text-center'>新規登録確認</h1>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <form action="{{ route('create.scheduled.check')}}" method="post">
                        @csrf
                        {{-- 商品名の表示の修正必要 --}}
                        <label for='name'>商品名</label>
                            <div>
                                {{ $goods_name }}
                            </div>
                        <label for='quantity'>数量</label>
                            <div>
                                {{ $params['quantity'] }}
                            </div>
                        <label for='date'>入荷予定日</label>
                            <div>
                                {{ $params['date'] }}
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
