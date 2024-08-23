<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者ダッシュボード</title>
</head>
<body>
    <ul class="nav-list2">
        <li class="list-items btn btn-danger"><a href="javascript:void(0);" onclick="confirmLogout()" class="nav-link">ログアウト</a></li>
    </ul>
    <div class="container">
        <h1>管理者ダッシュボード</h1>
        <p>ようこそ、{{ $admin->email }} さん。</p>
    </div>

    <h2>ユーザー一覧</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>メールアドレス</th>
                <th>作成日</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
    function confirmLogout() {
        if (confirm('ログアウトしてもよろしいですか？')) {
            window.location.href = "{{ route('admin.logout') }}";
        }
    }
</script>
</body>
</html>