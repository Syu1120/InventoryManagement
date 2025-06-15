<!-- 入荷予定一覧 -->

@extends('layouts.app')
@section('content')
<main>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('create.scheduled') }}">
                <button>入荷予定新規登録</button>
            </a>
            <form action="" method="post">
                {{-- <div class="d-flex flex-column"> --}}
                    <lavel for='name'>商品名</lavel>
                        <input type='text' class="form-control" name='name'>
                    <label for='date' class='mt-2'>日付</label>
                        <input type='date' class="form-control" name='date' id='date'/>
                {{-- </div> --}}
                <div class='row justify-content-center'>
                    <button type='submit' class='btn btn-primary w-25 mt-3'>検索</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ここから入荷予定一覧表示 --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-body">
                    <div class="d-flex align-items-center flex-column">
                        @forelse ($scheduleds as $scheduled)
                            <div class="card" style="width: 50%">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <div>
                                        <img src="{{ asset('storage/' . $scheduled->goods->image) }}" width="100" alt={{ $scheduled->goods->name }}>
                                    </div>
                                    <div>
                                        {{ $scheduled->goods->name }}
                                    </div>
                                    <div>
                                        数量 ： {{ $scheduled->quantity }}
                                    </div>
                                    <div>
                                        <button class="mt-3" data-bs-toggle="modal" data-bs-target="#modal{{ $scheduled->id }}">
                                            詳細
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="modal{{ $scheduled->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $scheduled->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel{{ $scheduled->id }}">{{ $scheduled->goods->name }}の詳細</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{ asset('storage/' . $scheduled->goods->image) }}" width="100" alt="{{ $scheduled->goods->name }}">
                                            <p>{{ $scheduled->goods->name }}</p>
                                            <p>数量：{{ $scheduled->quantity }}</p>
                                            <p>重量：{{ $scheduled->weight }}</p>
                                            <p>入荷予定日：{{ $scheduled->date }}<p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{ route('edit.scheduled', ['id' => $scheduled->id]) }}">
                                                <button>編集</button>
                                            </a>
                                            <button type="button" class="btn btn-danger" onclick="handleDelete({{ $scheduled->id }})">削除</button>
                                            <button type="button" class="btn btn-warning" onclick="handleConfirm({{ $scheduled->id }})">入荷確定</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
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

<script>
    function handleConfirm(scheduled) {
        if (confirm("本当に在庫を追加しますか？")) {
            fetch(`/goods_scheduled/add_to_stock/${scheduled}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
            })
            .then(response => {
                if (!response.ok) throw new Error("通信エラー");
                return response.json();
            })
            .then(data => {
                alert(data.message);
                location.reload();
            })
            .catch(error => {
                alert("エラーが発生しました: " + error.message);
            });
        }
    }

    function handleDelete(scheduled) {
        if (confirm("本当に削除しますか？")) {
            fetch(`/goods_scheduled/${scheduled}/delete`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
            })
            .then(response => {
                if (!response.ok) throw new Error("通信エラー");
                return response.json();
            })
            .then(data => {
                alert(data.message);
                location.reload();
            })
            .catch(error => {
                alert("エラーが発生しました: " + error.message);
            });
        }
    }
</script>
