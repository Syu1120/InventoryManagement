<!-- 在庫情報編集確認 -->

@extends('layouts.app')
@section('content')
<main class="py-4">
    <div class="col-md-5 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class='text-center'>在庫編集確認</h1>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <form action="{{ route('edit.stock.check', ['id' => $id])}}" method="post">
                        @csrf

                        <label for='quanity'>数量</label>
                            <div>
                                {{ $edit_input['quantity'] }}
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
