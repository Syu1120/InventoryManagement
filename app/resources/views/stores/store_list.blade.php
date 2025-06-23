<!-- 他店舗一覧 -->

@extends('layouts.app')
@section('content')
<main>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('create.store') }}">
                <button>店舗新規登録</button>
            </a>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-body">
                    <div class="d-flex align-items-center flex-column">
                         @forelse ($stores as $store)
                            <div>
                                <a href="{{ route('stockOtherStoreList', ['id' => $store->id]) }}">
                                    <button class="mt-3">{{ $store->name }}</button>
                                </a>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
