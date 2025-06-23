<!-- ユーザーパスワードリセットフォーム -->

@extends('layouts.app')
@section('content')
<main class="py-4">
    <div class="col-md-5 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class='text-center'>{{ __('Reset Password') }}</h1>
            </div>

            <div class="card-body">
                <div class="card-body">

                    <!-- バリデーションのAlertウィンドウ -->
                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                    </div>
                    @endif

                    <form method="POST" action="{{ url('/password/reset') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div>
                            <label>新しいパスワード</label>
                            <input type="password" name="password" required>
                        </div>

                        <div>
                            <label>パスワード確認</label>
                            <input type="password" name="password_confirmation" required>
                        </div>

                        <div class="row justify-content-center">
                            <button type="submit">パスワードをリセット</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
