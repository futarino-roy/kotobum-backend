<!-- resources/views/admin/dashboard.blade.php -->
@extends('admin.base')

@section('title', '管理者ダッシュボード')

@section('content')
    <ul class="nav-list2">
        <li class="list-items btn btn-danger"><a href="javascript:void(0);" onclick="confirmLogout()" class="nav-link">ログアウト</a></li>
    </ul>
    <h1>管理者ダッシュボード</h1>

    <h2>ユーザー一覧</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>メールアドレス</th>
                <th>テンプレート</th>
                <th>作成日</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->template }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('scripts')
<script>
function confirmLogout() {
    if (confirm('ログアウトしてもよろしいですか？')) {
        window.location.href = "{{ route('admin.logout') }}";
    }
}
</script>
@endsection