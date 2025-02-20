<!-- resources/views/admin/dashboard.blade.php -->
@extends('admin.base')

@section('title', 'ユーザー詳細ページ')

@section('content')
    <h1 style="margin-left:10%;">佐藤太郎 様 詳細ページ</h1>

    <h2 style="margin-left:10%;">基本情報</h2>

    <table border="1">
        <tbody>
            <tr><th>ID</th><td>1</td></tr>
            <tr><th>パスワード</th><td>12345678</td></tr>
            <tr><th>所属グループ</th><td>佐藤太郎</td></tr>
            <tr><th>選択フォーマット</th><td>1</td></tr>
            <tr><th>選択面</th><td>B面</td></tr>
            <tr><th>データ格納状況</th><td>全格納済み</td></tr>
            <tr><th>最終編集時刻</th><td>2025/1/10 00:00:00</td></tr>
            <tr><th>校了状態</th><td>校了済み</td></tr>
        </tbody>
        <tfoot>
            <tr><th>編集ページボタン</th><th>PDF化ボタン</th><th>データ削除ボタン（警告あり）</th></tr>
        </tfoot>
    </table>


    <div class="d-flex">
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ページ</th>
                    <th>内容</th>
                </tr>
        </thead>
            <tbody>
                <tr><th>1</th><td>1</td><td>ここに文章が入ります</td></tr>
                <tr><th>2</th><td>1</td><td>ここに文章が入ります</td></tr>
                <tr><th>3</th><td>1</td><td>ここに文章が入ります</td></tr>
                <tr><th>4</th><td>2</td><td>ここに文章が入ります</td></tr>
                <tr><th>…</th><td>…</td><td>……</td></tr>
            </tbody>
        </table>

    
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ページ</th>
                    <th>内容</th>
                </tr>
        </thead>
        <tbody>
                <tr><th>1</th><td>1</td><td>画像</td></tr>
                <tr><th>2</th><td>1</td><td>画像</td></tr>
                <tr><th>3</th><td>1</td><td>画像</td></tr>
                <tr><th>4</th><td>2</td><td>画像</td></tr>
                <tr><th>…</th><td>…</td><td>……</td></tr>
            </tbody>
        </table>
    </div>


    <!-- テキストデータ表と画像票のレイアウトは検討　ページごとという案もある -->


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