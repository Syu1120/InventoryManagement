@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div class="d-flex align-items-center flex-column">
                        <a href="{{ route('stockList') }}">
                            <button class="mt-3">自店舗在庫一覧</button>
                        </a>

                        @if ($role == 0)
                        <a href="{{ route('storeList') }}">
                            <button class="mt-3">他店舗一覧</button>
                        </a>
                        <a href="{{ route('goodsList') }}">
                            <button class="mt-3">商品情報一覧</button>
                        </a>
                        <a href="{{ route('userList') }}">
                            <button class="mt-3">ユーザー一覧</button>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
