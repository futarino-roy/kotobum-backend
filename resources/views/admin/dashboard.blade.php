<!-- resources/views/admin/dashboard.blade.php -->
@extends('admin.base')

@section('title', '管理者ダッシュボード')

@section('content')
    <h1>管理者仮トップページ</h1>

    <h3><a href="{{ route('admin.group_dashbord') }}">レイアウト確認ページ</a></h3>

    <h2 style="margin-left:10%;">ユーザー一覧</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>ログインID</th>
                <th>A面B面</th>
                <th>フォーマット</th>
                <!-- <th>パートナー</th>
                <th>フタリノ状況</th> -->
                <th>作成日</th>
                <th>編集</th>
                <!-- <th>Body編集（仮）</th> -->
                <!-- <th>coverPDF</th> -->
                <th>中身PDF</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->login_id }}</td>
                    <td>{{ $user->template }}</td>
                    <td>{{ $user->format }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td><a href="{{ route('admin_user_redirect', ['userid' => $user->id, 'parts' => 'body']) }}" target="_blank">編集</a></td>
                    <!-- <td><a href="{{ route('admin.coverHTML', $user->id) }}">PDF</a></td> -->
                    <td><a href="{{ route('admin.bodyHTML', $user->id) }}" target="_blank">PDF</a></td>
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