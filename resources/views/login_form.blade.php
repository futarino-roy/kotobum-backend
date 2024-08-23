@extends('admin.base')

@section('content')
    <h1>ログイン</h1>
    <form action="{{ route('admin.login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">ログイン</button>
    </form>
@endsection