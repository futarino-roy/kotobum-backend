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

    <h2 style="margin-left:10%;">ユーザー作成</h2>
    <form action="" method="POST">
        @csrf
        <div class="mb-3">
            <label for="group_id" class="form-label">グループID</label>
            <input type="number" class="form-control" id="group_id" name="group_id" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">名前</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="login_id" class="form-label">ログインID</label>
            <input type="text" class="form-control" id="login_id" name="login_id" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">パスワード</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="template" class="form-label">テンプレート</label>
            <input type="text" class="form-control" id="template" name="template" required>
        </div>
        <div class="mb-3">
            <label for="format" class="form-label">フォーマット</label>
            <input type="number" class="form-control" id="format" name="format" required>
        </div>
        <button type="submit" class="btn btn-primary">ユーザー作成</button>
    </form>

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