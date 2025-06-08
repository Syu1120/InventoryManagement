<!-- 商品新規登録確認 -->

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
                    <form action="{{ route('create.goods.check')}}" method="post">
                        @csrf

                        @if ($image_url)
                        <label for='name'>画像</label>
                            <div>
                                <img src="{{ $image_url }}" width="200" alt={{ $params['name'] }}>
                            </div>
                        @endif

                        <label for='name'>商品名</label>
                            <div>
                                {{ $params['name'] }}
                            </div>
                        <label for='weight'>重量</label>
                            <div>
                                {{ $params['weight'] }}
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
