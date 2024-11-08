<!-- resources/views/admin/dashboard.blade.php -->
@extends('admin.base')

@section('title', '管理者ダッシュボード')

@section('content')
    <h1>管理者ダッシュボード</h1>

    <h2>ユーザー一覧</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>メールアドレス</th>
                <th>A面B面</th>
                <th>作成日</th>
                <th>Cover編集（仮）</th>
                <th>Body編集（仮）</th>
                <th>coverPDF</th>
                <th>bodyPDF</th>
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
                    <td><a href="{{ route('', $) }}">編集</a></td>
                    <td><a href="{{ route('', $) }}">編集</a></td>
                    <td><a href="{{ route('', $) }}">PDF</a></td>
                    <td><a href="{{ route('', $) }}">PDF</a></td>
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