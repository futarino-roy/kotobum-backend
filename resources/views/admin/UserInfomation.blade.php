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
            <tr><th>ログインID</th><td>{{ $user->login_id }}</td>
            <tr><th>パスワード</th><td><button class="reset-password-btn btn btn-danger" data-route="{{ route('admin.reset-password', ['id' => 'USER_ID']) }}" data-id="{{ $user->id }}">リセット</button></td></tr>
            <tr><th>所属グループ</th><td>{{ $user->Group->name }}</td></tr>
            <tr><th>選択フォーマット</th><td>{{ $formats[$user->format] ?? '不明' }}</td></tr>
            <tr><th>選択面</th><td>{{ $user->template }}</td></tr>
            <tr><th>未格納画像数</th><td>{{ $naCount }}</td></tr>
            <tr><th>最終編集時刻</th><td>{{ $user->Album->body->update_at ?? 'N/A'}}</td></tr>
            <tr>
                <th>表紙校了状態</th>
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
            </tr>
            <tr>
                <th>中身校了状態</th>
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
            </tr>
        </tbody>
        <tfoot>
            <tr>
            <th><a href="{{ route('admin_user_redirect', ['userid' => $user->id, 'parts' => 'cover']) }}" target="_blank">表紙編集</a></th>
            <th><a href="{{ route('admin_user_redirect', ['userid' => $user->id, 'parts' => 'body']) }}" target="_blank">中身編集</a></th>
                <th>
                    <a class="btn btn-warning"
                        href="{{ route('admin.delete_user', ['userid' => $user->id]) }}"
                        onclick="return confirm('本当に削除しますか？この操作は取り消せません。')"
                        style="color: red;">データ削除
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

        <!-- モーダル (入力用) -->
        <div id="resetPasswordModal" class="modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">新しいパスワードを入力</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="newPassword" class="form-control" placeholder="新しいパスワード">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                        <button type="button" id="confirm-reset" class="btn btn-danger">確定</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="warningModal" class="modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">警告</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>本当にパスワードをリセットしますか？</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                        <button type="button" id="confirm-warning" class="btn btn-danger">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- モーダル (結果表示) -->
        <div id="resultModal" class="modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">パスワードリセット完了</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>新しいパスワード: <strong id="newPasswordDisplay"></strong></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
function confirmLogout() {
    if (confirm('ログアウトしてもよろしいですか？')) {
        window.location.href = "{{ route('admin.logout') }}";
    }
}

document.addEventListener("DOMContentLoaded", function () {
    let selectedUserId = null;
    let enteredPassword = null;

    document.querySelectorAll(".reset-password-btn").forEach(button => {
        button.addEventListener("click", function () {
            selectedUserId = this.getAttribute("data-id");
            let passwordModal = new bootstrap.Modal(document.getElementById("resetPasswordModal"));
            passwordModal.show();
        });
    });

    document.getElementById("confirm-reset").addEventListener("click", function () {
        let passwordInput = document.getElementById("newPassword");
        if (!passwordInput) {
            console.error("新しいパスワードの入力フィールドが見つかりません。");
            return;
        }

        enteredPassword = passwordInput.value;

        if (enteredPassword.length < 8) {
            alert("パスワードは8文字以上で入力してください。");
            return;
        }

        let warningModalElement = document.getElementById("warningModal");
        if (!warningModalElement) {
            console.error("警告モーダルが見つかりません。");
            return;
        }

        let warningModal = new bootstrap.Modal(warningModalElement);
        warningModal.show();
    });

    let confirmWarningBtn = document.getElementById("confirm-warning");
    if (confirmWarningBtn) {
        confirmWarningBtn.addEventListener("click", function () {
            fetch(`/admin/${selectedUserId}/reset-password/`, { 
                method: "POST",
                headers: { 
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ new_password: enteredPassword })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let warningModal = bootstrap.Modal.getInstance(document.getElementById("warningModal"));
                    warningModal.hide();

                    document.getElementById("newPasswordDisplay").textContent = enteredPassword;
                    let displayPasswordModal = new bootstrap.Modal(document.getElementById("resultModal"));
                    displayPasswordModal.show();
                } else {
                    alert("エラーが発生しました。");
                }
            })
            .catch(error => console.error("Error:", error));
        });
    } else {
        console.error("confirm-warning ボタンが見つかりません。");
    }
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