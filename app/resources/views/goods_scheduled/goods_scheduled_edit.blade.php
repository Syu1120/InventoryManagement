<!-- 入荷予定編集フォーム -->

@extends('layouts.app')
@section('content')
<main class="py-4">
    <div class="col-md-5 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class='text-center'>入荷予定編集</h1>
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

                    <form action="{{ route('edit.scheduled', ['id' => $scheduled->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <label for='quantity'>数量</label>
                            <input type='text' class='form-control' name='quantity' value="{{ old('quantity', $scheduled->quantity) }}"/>
                        <label for='date'>入荷予定日</label>
                            <input type='date' class='form-control' name='date' value="{{ old('date', $scheduled->date) }}"/>
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

