<!-- ユーザー一覧 -->

@extends('layouts.app')
@section('content')
<main>
    <a href="{{ route('create.user') }}">
        <button>ユーザー登録</button>
    </a>
</main>
@endsection
