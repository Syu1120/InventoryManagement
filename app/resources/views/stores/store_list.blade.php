<!-- 他店舗一覧 -->

@extends('layouts.app')
@section('content')
<main>
    <a href="{{ route('scheduledList') }}">
        <button>入荷予定一覧</button>
    </a>
</main>
@endsection
