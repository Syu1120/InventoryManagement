<!-- 入荷予定一覧 -->

@extends('layouts.app')
@section('content')
<main>
    <a href="{{ route('create.scheduled') }}">
        <button>入荷予定新規登録</button>
    </a>
</main>
@endsection
