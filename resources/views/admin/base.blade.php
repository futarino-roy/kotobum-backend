<!-- resources/views/admin/base.blade.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'デフォルトタイトル')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/base.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- フラッシュメッセージの表示 -->
        <!-- @if (session('login_msg'))
            <div class="alert alert-success" id="flash-message">
                {{ session('login_msg') }}
            </div>
        @endif -->

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- メインコンテンツ -->
        @yield('content')
    </div>
    <footer class="footer bg-dark text-center text-light p-2 z-3 fixed-bottom" style=" vertical-align: center;">
        コトバム公式管理者用サイト.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script>
        // フラッシュメッセージを数秒後に非表示にする
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(function () {
                var flashMessage = document.getElementById('flash-message');
                if (flashMessage) {
                    flashMessage.style.display = 'none';
                }
            }, 3000); // 3秒後にメッセージを非表示にする
        });
    </script> -->
    @yield('scripts')
</body>
</html>
