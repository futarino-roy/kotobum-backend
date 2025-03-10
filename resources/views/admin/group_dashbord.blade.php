<!-- resources/views/admin/dashboard.blade.php -->
@extends('admin.base')

@section('title', 'グループダッシュボード')

@section('content')
    <h2>グループ作成</h2>
    <form action="" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">グループ名</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="format" class="form-label">フォーマット</label>
            <input type="number" class="form-control" id="format" name="format" required>
        </div>
        <button type="submit" class="btn btn-primary">グループ作成</button>
    </form>

    <hr>

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
                <td>詳細ボタン</td>
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
            @foreach ($groups as $group)
            <tr>
                <td>{{ $group->id }}</td>
                <td>{{ $group->name }}</td>
                <td>{{ $group->plan }}</td>
                <td>{{ $user->format }}</td>
                <td>{{ $user->created_at }}</td>
                <td><a href="{{ route('admin.group_infomation', $group->id) }}">詳細ボタン</a></td>
                <td>完了状態</td>
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