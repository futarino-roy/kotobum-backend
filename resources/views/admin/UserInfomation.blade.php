<!-- resources/views/admin/dashboard.blade.php -->
@extends('admin.base')

@section('title', '管理者ダッシュボード')

@section('content')
    <h1>管理者ダッシュボード</h1>

    <h2 style="margin-left:10%;">ユーザー詳細情報</h2>
    <table border="1">
        <thead>
            <tr>
            </tr>
        </thead>
        <tbody>
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