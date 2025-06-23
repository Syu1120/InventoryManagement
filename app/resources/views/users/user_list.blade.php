<!-- ユーザー一覧 -->

@extends('layouts.app')
@section('content')
<main>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('create.user') }}">
                <button>ユーザー登録</button>
            </a>
            <form action="{{ route('search.user') }}" method="GET">
                {{-- <div class="d-flex flex-column"> --}}
                    <lavel for='name'>ユーザー名</lavel>
                        <input type='text' class="form-control" name='name'>
                {{-- </div> --}}
                <div class='row justify-content-center'>
                    <button type='submit' class='btn btn-primary w-25 mt-3'>検索</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ここからユーザー一覧表示 --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-body">
                    <div class="d-flex align-items-center flex-column">
                        @forelse ($users as $user)
                            <div class="card" style="width: 100%">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        {{ $user['name'] }}
                                    </div>
                                    <div>
                                        <button class="mt-3" data-bs-toggle="modal" data-bs-target="#modal{{ $user->id }}">
                                            詳細
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="modal{{ $user->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $user->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel{{ $user->id }}">{{ $user->name }}の詳細</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>名前：{{ $user->name }}</p>
                                            <p>メールアドレス：{{ $user->email }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-warning" onclick="sendResetMail({{ $user->id }})">パスワードリセット</button>
                                            <button type="button" class="btn btn-danger" onclick="handleDelete({{ $user->id }})">削除</button>
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

<script>
    function handleDelete(user) {
        if (confirm("本当に削除しますか？")) {
            fetch(`/user/${user}/delete`, {
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

    function sendResetMail(userId) {
        if (!confirm('本当にパスワード再設定メールを送信しますか？')) return;

        fetch(`/users/${userId}/send-reset-mail`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        })
        .then(response => {
            if (response.ok) {
                alert('パスワード再設定メールを送信しました');
            } else {
                alert('送信に失敗しました');
            }
        });
    }
</script>
