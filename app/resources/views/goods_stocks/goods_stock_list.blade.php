<!-- 在庫一覧 -->

@extends('layouts.app')
@section('content')
<main>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('scheduledList') }}">
                <button>入荷予定一覧</button>
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
</main>
@endsection
