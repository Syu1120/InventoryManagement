<!-- 店舗新規登録フォーム -->

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
                    <form action="{{ route('create.store')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <label for='name'>店舗名</label>
                            <input type='text' class='form-control' name='name'/>
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
