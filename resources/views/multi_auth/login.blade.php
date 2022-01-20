@extends('layouts.app')

@section('content')

<div class="container">
    <form method="POST" action="multi_login">
        @csrf
        <div class="p-3">
            @error('auth')
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-3">
                &#x26A0; {{ $message }}
            </div>
            @enderror
            <div class="form-group">
                <label>メールアドレス：<input type="email" name="email" class="form-control" placeholder="name@example.com"></label>
            </div>
            <div class="form-group">
                <label>パスワード：<input type="password" name="password" class="form-control"></label>
            </div>
            <div class="form-group">
                <label>ユーザータイプ：
                    <select name="guard" class="form-control">
                        <option value="" selected disabled>選択してください</option>
                        <option value="diyers">DIYer</option>
                        <option value="mentors">Mentor</option>
                    </select>
                </label>
            </div>
            <button type="submit" class="btn btn-primary">ログイン</button>
        </div>
    </form>
</div>

@endsection
