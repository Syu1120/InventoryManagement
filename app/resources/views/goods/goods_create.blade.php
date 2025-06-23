<!-- 商品新規登録フォーム -->

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

                    <!-- バリデーションのAlertウィンドウ -->
                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                    </div>
                    @endif

                    <form action="{{ route('create.goods')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <label for='image'>画像</lavel>
                            <input type="file" class='form-control' name='image' value="{{ old('image') }}">
                        <label for='name'>商品名</label>
                            <input type='text' class='form-control' name='goods_name' value="{{ old('goods_name') }}"/>
                        <label for='weight'>重量</label>
                            <input type='text' class='form-control' name='weight' value="{{ old('weight') }}"/>
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
