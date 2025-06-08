<!-- 商品情報一覧 -->

@extends('layouts.app')
@section('content')
<main>
    <a href="{{ route('create.goods') }}">
        <button>商品新規登録</button>
    </a>
</main>
@endsection
