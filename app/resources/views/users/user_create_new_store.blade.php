<!-- ユーザー新規登録フォーム -->

@extends('layouts.app')
@section('content')
<main class="py-4">
    <div class="col-md-5 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class='text-center'>新規登録</h1>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <form action="{{ route('create.newStore.user', ['id' => $store_id])}}" method="post">
                        @csrf

                        <label for='name'>名前</label>
                            <input type='text' class='form-control' name='name' value="{{ old('name') }}"/>
                        <label for='email'>メールアドレス</label>
                            <input type='text' class='form-control' name='email' value="{{ old('email') }}"/>
                        <label for='password'>パスワード</label>
                            <input type='password' class='form-control' name='password'/>
                        <label for='password_confirmation'>パスワード（確認）</label>
                            <input type='password' class='form-control' name='password_confirmation'/>
                        <div class='row justify-content-center'>
                            <button type='submit' class='btn btn-primary w-25 mt-3'>登録</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
