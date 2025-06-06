<!-- ホーム画面 -->

@extends('layouts.header')
@section('content')
<main>
    <a href="{{ route('stockList') }}">
        <button>自店舗在庫一覧</button>
    </a>
    <a href="{{ route('storeList') }}">
        <button>他店舗一覧</button>
    </a>
    <a href="{{ route('goodsList') }}">
        <button>商品情報一覧</button>
    </a>
    <a href="{{ route('userList') }}">
        <button>ユーザー一覧</button>
    </a>
</main>