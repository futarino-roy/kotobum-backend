<!-- resources/views/admin/dashboard.blade.php -->
@extends('admin.base')

@section('title', '管理者ダッシュボード')

@section('content')
    <h1>管理者ダッシュボード</h1>

    <h2 style="margin-left:10%;">ユーザー一覧</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>ログインID</th>
                <th>A面B面</th>
                <th>パートナー</th>
                <th>フタリノ状況</th>
                <th>作成日</th>
                <!-- <th>Cover編集（仮）</th>
                <th>Body編集（仮）</th> -->
                <th>coverPDF</th>
                <th>bodyPDF</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->login_id }}</td>
                    <td>{{ $user->template }}</td>
                    <td>{{ $user->partner->name }}</td>
                    <td><a href="{{ route('admin.showPartner', $user->id) }}">フタリノ画面</a></td>
                    <td>{{ $user->created_at }}</td>
                    <td><a href="{{ route('admin.coverHTML', $user->id) }}">PDF</a></td>
                    <td><a href="{{ route('admin.bodyHTML', $user->id) }}">PDF</a></td>
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