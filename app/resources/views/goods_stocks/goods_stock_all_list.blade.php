<!-- 在庫一覧 -->

@extends('layouts.app')
@section('content')
<main>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex flex-column">
                <a href="{{ route('scheduledList') }}">
                    <button class="mt-3">入荷予定一覧</button>
                </a>
                <a href="{{ route('storeList') }}">
                    <button class="mt-3">店舗一覧画面へ</button>
                </a>
            </div>
            <form action="{{ route('search.all.stock') }}" method="GET">
                {{-- <div class="d-flex flex-column"> --}}
                    <label for='goods_name'>商品名</label>
                        <input type='text' class="form-control" name='goods_name' value="{{ request('goods_name') }}">
                    <label for='store_name'>店舗名</label>
                        <input type='text' class="form-control" name='store_name' value="{{ request('store_name') }}">
                    <label for='date' class='mt-2'>日付</label>
                        <input type='date' class="form-control" name='date' id='date' value="{{ request('date') }}">
                {{-- </div> --}}
                <div class='row justify-content-center'>
                    <button type='submit' class='btn btn-primary w-25 mt-3'>検索</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ここから在庫一覧表示 --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-body">
                    <div class="d-flex align-items-center flex-column">
                        @forelse ($stocks as $stock)
                            <div class="card" style="width: 50%">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <div>
                                        <img src="{{ asset('storage/' . $stock->goods->image) }}" width="100" alt={{ $stock->goods->name }}>
                                    </div>
                                    <div>
                                        {{ $stock->goods->name }}
                                    </div>
                                    <div>
                                        数量 ： {{ $stock->quantity }}
                                    </div>
                                    <div>
                                        <button class="mt-3" data-bs-toggle="modal" data-bs-target="#modal{{ $stock->id }}">
                                            詳細
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="modal{{ $stock->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $stock->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel{{ $stock->id }}">{{ $stock->goods->name }}の詳細</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{ asset('storage/' . $stock->goods->image) }}" width="100" alt="{{ $stock->goods->name }}">
                                            <p>{{ $stock->goods->name }}</p>
                                            <p>数量：{{ $stock->quantity }}</p>
                                            <p>重量：{{ $stock->weight }}</p>
                                            <p>入荷予定日：{{ $stock->date }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button> --}}
                                        </div>
                                    </div>
                                </div>
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
