<!-- resources/views/admin/dashboard.blade.php -->
@extends('admin.base')

@section('title', 'ユーザー詳細ページ')

@section('content')
    @php
        $naCount = 0;
    @endphp

    @if (!empty($imageData))
        @foreach ($imageData as $image)
            @php 
                if (!isset($image->image)) $naCount++; 
            @endphp
        @endforeach
    @endif

    <h1 style="margin-left:10%;">{{ $user->name }} 様 詳細ページ</h1>

    <h2 style="margin-left:10%;">基本情報</h2>

    <table border="1">
        <tbody>
            <tr><th>ID</th><td>{{ $user->id }}</td></tr>
            <tr><th>名前</th><td>{{ $user->name }}</td></tr>
            <tr><th>パスワード</th><td>{{ $user->password }}</td></tr>
            <tr><th>所属グループ</th><td>{{ $user->Group->name }}</td></tr>
            <tr><th>選択フォーマット</th><td>{{ $user->format }}</td></tr>
            <tr><th>選択面</th><td>{{ $user->template }}</td></tr>
            <tr><th>未格納画像数</th><td>{{ $naCount }}</td></tr>
            <tr><th>最終編集時刻</th><td>{{ $user->Album->body->update_at ?? 'N/A'}}</td></tr>
            <tr><th>校了状態</th><td>{{ $user->Album->body_is_sent ? '校了済み' : '未校了' }}</td></tr>
        </tbody>
        <tfoot>
            <tr>
                <th><a href="{{ route('admin_user_redirect', ['userid' => $user->id, 'parts' => 'body']) }}" target="_blank">編集ページボタン</a></th>
                <th>
                    <a href="{{ route('admin.delete_user', ['userid' => $user->id]) }}"
                        onclick="return confirm('本当に削除しますか？この操作は取り消せません。')"
                        style="color: red;">データ削除ボタン
                    </a>
                </th>
            </tr>
        </tfoot>
    </table>


    <div class="d-flex justify-content-between">
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ページ</th>
                    <th>内容</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($textData))
                    @foreach ($textData as $text)
                    <tr>
                        <th>{{ $text->id ?? 'N/A' }}</th>
                        <td>{{ $text->page ?? 'N/A' }}</td>
                        <td>{{ $text->text ?? 'N/A' }}</td>
                    </tr>
                    @endforeach
                @endif
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
                @if (!empty($imageData))
                    @foreach ($imageData as $image)
                    <tr>
                        <th>{{ $image->id ?? 'N/A' }}</th>
                        <td>{{ $image->page ?? 'N/A' }}</td>
                        <td>{{ $image->image ?? 'N/A' }}</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

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