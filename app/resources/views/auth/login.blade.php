<!-- 商品情報編集フォーム -->

@extends('layouts.app')
@section('content')
<main class="py-4">
    <div class="col-md-5 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class='text-center'>ログイン</h1>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <form action="{{ route('login') }}" method="post">
                        @csrf

                        <label for='email'>メールアドレス</label>
                            <input type='text' class='form-control' id='email' name='email' value="{{ old('email') }}"/>
                        <label for='password'>パスワード</label>
                            <input type='password' class='form-control' id='password' name='password'/>
                        <div class='row justify-content-center'>
                            <button type='submit' class='btn btn-primary w-25 mt-3'>ログイン</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
