<!-- resources/views/admin/login.blade.php -->
@extends('admin.base')

@section('title', 'ログイン')

@section('content')
    <h1>管理者ログイン</h1>

    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">メールアドレス</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">パスワード</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">ログイン</button>
    </form>
@endsection
