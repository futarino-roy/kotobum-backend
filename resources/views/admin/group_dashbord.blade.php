<!-- resources/views/admin/dashboard.blade.php -->
@extends('admin.base')

@section('title', 'グループダッシュボード')

@section('content')
    @php
        $formats = [
            4 => 'ペア１',
            3 => 'ペア２',
            1 => 'ペア３',
            2 => 'ペア４',
            5 => 'ソロ１',
            6 => 'ソロ２',
            7 => 'ソロ３',
        ];
    @endphp

    <h2>グループ作成</h2>
    <form action="{{ route('admin.create_group') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">グループ名</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="format" class="form-label">フォーマット</label>
            <select class="form-control" id="format" name="format" required>
                <option value="4">ペア１</option>
                <option value="3">ペア２</option>
                <option value="1">ペア３</option>
                <option value="2">ペア４</option>
                <option value="5">ソロ１</option>
                <option value="6">ソロ２</option>
                <option value="7">ソロ３</option>
            </select>
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
            </tr>
        </thead>
        <tbody>
            @foreach ($groups as $group)
            <tr>
                <td>{{ $group->id }}</td>
                <td>{{ $group->name }}</td>
                <td>{{ $group->plan }}</td>
                <td>{{ $formats[$group->format] }}</td>
                <td>{{ $group->created_at }}</td>
                <td><a href="{{ route('admin.group_infomation', $group->id) }}">詳細ボタン</a></td>
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