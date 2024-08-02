@extends('original_admin.base')

@section('content')

<h1>管理者ログイン</h1>

@error('login')
<p>{{ $message }}</p>
@enderror

<form method="POST" action="{{ route('original_admin.login') }}">
    @csrf
    <div class="form-group">
        <label>メールアドレス</label>
        <input type="email" name="email" class="form-control"><br>
    </div>
    <div class="form-group">
        <label>パスワード</label>
        <input type="password" name="password" class="form-control"><br>
    </div>
    <input type="submit" value="ログイン" class="btn btn-primary">
</form>
@endsection
