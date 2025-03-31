<!-- resources/views/admin/dashboard.blade.php -->
@extends('admin.base')

@section('title', 'ユーザー詳細ページ')

@section('content')
    @php
        $naCount = 0;
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

    @if (!empty($imageData))
        @foreach ($imageData as $image)
            @php 
                if (!isset($image['image'])) $naCount++; 
            @endphp
        @endforeach
    @endif

    @if(session('newPassword'))
    <div class="alert alert-success">
        {{ session('success') }}
        <br>
        新しいパスワード: {{ session('newPassword') }}
    </div>
    @endif

    <h1 style="margin: 100px 0 30px 10%;">{{ $user->name }} 様 詳細ページ</h1>

    <div class="d-flex justify-content-between">
        <h2 style="margin-left:10%;">基本情報</h2>
        <a class="btn btn-warning"
            href="{{ route('admin.delete_user', ['userid' => $user->id]) }}"
            onclick="return confirm('本当に削除しますか？この操作は取り消せません。')"
            style="color: red; margin-right:10%;">データ削除
        </a>
    </div>

    <table border="1">
        <tbody>
            <tr><th>ID</th><td colspan="2">{{ $user->id }}</td></tr>
            <tr><th>名前</th><td colspan="2">{{ $user->name }}</td></tr>
            <tr><th>ログインID</th><td colspan="2">{{ $user->login_id }}</td>
            <tr><th>パスワード</th><td colspan="2"> <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#resetPasswordModal">リセット</button></td></tr>
            <tr><th>所属グループ</th><td colspan="2">{{ $user->Group->name }}</td></tr>
            <tr><th>選択フォーマット</th><td colspan="2">{{ $formats[$user->format] ?? '不明' }}</td></tr>
            <tr><th>選択面</th><td colspan="2">{{ $user->template }}</td></tr>
            <tr><th>未格納画像数</th><td colspan="2">{{ $naCount }}</td></tr>
            <tr><th>最終編集時刻</th><td colspan="2">{{ $user->Album->body->update_at ?? 'N/A'}}</td></tr>
            <tr>
                <th>表紙状態</th>
                <td>
                    {{ $user->Album->cover_is_sent ? '校了済み' : '未校了' }}
                    @if($user->Album->cover_is_sent)
                        <button class="reset-status-btn btn btn-warning"
                                data-route="{{ route('admin.reset-status', ['id' => $user->Album->id, 'type' => 'cover']) }}"
                                data-type="cover">
                            未校了に戻す
                        </button>
                    @endif
                </td>
                <td><a href="{{ route('admin_user_redirect', ['userid' => $user->id, 'parts' => 'cover']) }}" target="_blank">表紙編集</a></td>
            </tr>
            <tr>
                <th>中身状態</th>
                <td>
                    {{ $user->Album->body_is_sent ? '校了済み' : '未校了' }}
                    @if($user->Album->body_is_sent)
                        <button class="reset-status-btn btn btn-warning"
                                data-route="{{ route('admin.reset-status', ['id' => $user->Album->id, 'type' => 'body']) }}"
                                data-type="body">
                            未校了に戻す
                        </button>
                    @endif
                </td>
                <td><a href="{{ route('admin_user_redirect', ['userid' => $user->id, 'parts' => 'body']) }}" target="_blank">中身編集</a></td>
            </tr>
        </tbody>
    </table>

    <div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resetPasswordModalLabel">パスワードリセット</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.reset-password', $user->id) }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="password" class="form-label">新しいパスワード(八桁)</label>
                            <input type="text" class="form-control" id="password" name="password" required minlength="8">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                        <button type="submit" class="btn btn-primary" onclick="return confirm('本当にリセットしますか？この操作は取り消せません。')">パスワードをリセット</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="d-flex justify-content-between">
        <table border="1" style="margin-right: 20px;">
            <thead>
                <tr>
                    <th style="width: 17ch;">ID</th>
                    <th style="width: 5ch;">ページ</th>
                    <th>内容</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($textData))
                    @foreach ($textData as $text)
                    <tr>
                        <th>{{ $text['id'] ?? 'N/A' }}</th>
                        <td>{{ $text['pageNumber'] ?? 'N/A' }}</td>
                        <td style="text-transform: none;">
                            {{ $text['text'] ?? 'N/A' }}
                            @if (!empty($text['text']))
                            <br>
                            <button class="copy-text-btn" data-text="{{ $text['text'] }}">コピー</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

    
        <table border="1" style="margin-left: 20px;">
            <thead>
                <tr>
                    <th style="width: 17ch;">ID</th>
                    <th style="width: 5ch;">ページ</th>
                    <th>内容</th>
                </tr>
            </thead>
            <tbody>
            @if (!empty($imageData) && is_array($imageData))
                @foreach ($imageData as $image)
                    <tr>
                        <th>{{ $image['id'] ?? 'N/A' }}</th>
                        <td>{{ $image['pageNumber'] ?? 'N/A' }}</td>
                        <td style="text-transform: none;">
                            @if (!empty($image['image']))
                                <img src="{{ $image['image'] }}" alt="Image" style="max-width: 100px; max-height: 100px;">
                                <br>
                                <a href="{{ $image['image'] }}" download="image.png" class="btn btn-success">DL</a>
                            @else
                                N/A
                            @endif
                        </td>
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

document.querySelectorAll(".copy-text-btn").forEach(button => {
        button.addEventListener("click", function () {
            let textToCopy = this.getAttribute("data-text");
            navigator.clipboard.writeText(textToCopy).then(() => {
                alert("テキストをコピーしました！");
            }).catch(err => {
                console.error("コピーに失敗しました", err);
            });
        });
    });

document.querySelectorAll(".reset-status-btn").forEach(button => {
    button.addEventListener("click", function () {
        let resetRoute = this.getAttribute("data-route");
        let type = this.getAttribute("data-type");

        if (!confirm(`本当に「${type === 'cover' ? '表紙' : '中身'}」を未校了に戻しますか？`)) {
            return;
        }

        fetch(resetRoute, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            }
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            location.reload(); // ページを更新して状態を反映
        })
        .catch(error => console.error("エラー:", error));
    });
});
</script>
@endsection