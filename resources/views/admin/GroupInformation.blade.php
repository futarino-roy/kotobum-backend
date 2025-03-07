<!-- resources/views/admin/dashboard.blade.php -->
@extends('admin.base')

@section('title', 'ユーザー詳細ページ')

@section('content')
    <h1 style="margin-left:10%;">佐藤家 詳細ページ</h1>

    <h2 style="margin-left:10%;">基本情報</h2>

    <table border="1">
        <tbody>
            <tr>
                <th>校了状態:両方済み</td>
                <th>選択FMT:1</th>
                <th>表紙PDFボタン</th>
                <th>全体データ削除</th></tr>
        </tbody>
    </table>


    <table border="1">
        <thead>
            <tr>
                <th></th>
                <th>ID</th>
                <th>名前</th>
                <th>最終更新時間</th>
                <th>未格納画像</th>
                <th>校了状態</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>A面</th>
                <th>1</th>
                <th>佐藤太郎</th>
                <th>2025/1/10 10:00:00</th>
                <th>全格納済み</th>
                <th>校了済み</th>
                <th><a href="{{ route('admin.user_infomation') }}">詳細ボタン</a></th>
                <th>編集ボタン</th>
                <th>割り当て解除</th>
            </tr>
            <tr>
                <th>B面</th>
                <th>1</th>
                <th>佐藤花子</th>
                <th>2025/1/10 00:00:00</th>
                <th>全格納済み</th>
                <th>校了済み</th>
                <th>詳細ボタン</th>
                <th>編集ボタン</th>
                <th>割り当て解除</th>
            </tr>
        </tbody>
    </table>


    <hr>

    <h1 style="margin-left:10%;">検索機能付きページ下部に割り当て用のユーザー一覧</h1>

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