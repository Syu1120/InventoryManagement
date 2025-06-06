<!-- 在庫一覧 -->

@extends('layouts.header')
@section('content')
<main>
    <a href="{{ route('scheduledList') }}">
        <button>入荷予定一覧</button>
    </a>
</main>