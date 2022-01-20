@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">質問を登録する</div>

    <form class="card-body" action="{{ route('register_question') }}" method="POST">
        @csrf
        <div class="form-group">
            <textarea class="form-control" rows="3" name="content" placeholder="質問を入力してください"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">登録</button>
    </form>
</div>

@endsection
