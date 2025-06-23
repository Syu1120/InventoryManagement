<!-- ユーザー新規登録確認 -->

@extends('layouts.app')
@section('content')
<main class="py-4">
    <div class="col-md-5 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class='text-center'>新規登録確認</h1>
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

                    <form action="{{ route('create.user.check')}}" method="post">
                        @csrf
                        <label for='name'>名前</label>
                            <div>
                                {{ $params['name'] }}
                            </div>
                        <label for='email'>メールアドレス</label>
                            <div>
                                {{ $params['email'] }}
                            </div>
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
