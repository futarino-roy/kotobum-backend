<!-- resources/views/admin/dashboard.blade.php -->
@extends('admin.base')

@section('title', 'グループダッシュボード')

@section('content')
    <h1 style="margin-left:10%;">ページ上部にグループ作成領域</h1>

    <br />

    <h2 style="margin-left:10%;">グループ一覧</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>グループ名</th>
                <th>プラン</th>
                <th>フォーマット</th>
                <th>作成日</th>
                <th>詳細</th>
                <th>完了状態</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>1</td>
                    <td>佐藤家</td>
                    <td>ペア</td>
                    <td>1</td>
                    <td>2025/1/1</td>
                    <td><a href="{{ route('admin.group_infomation') }}">詳細ボタン</a></td>
                    <th>校了済み</th>
                </tr>
                <tr>
                    <td>2</td>
                    <td>田中ソロ</td>
                    <td>ソロ</td>
                    <td>2</td>
                    <td>2025/1/1</td>
                    <td>詳細ボタン</td>
                    <th>完了</th>
                </tr>
                <tr>
                    <td>3</td>
                    <td>テスト</td>
                    <td>null</td>
                    <td>3</td>
                    <td>2025/1/1</td>
                    <td>詳細ボタン</td>
                    <th>編集中</th>
                </tr>
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