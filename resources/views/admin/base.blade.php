<!-- resources/views/admin/base.blade.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'デフォルトタイトル')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/base.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    body {
        padding-bottom: 50px; /* フッター高さ分の余白 */
    }

    table {
      width: 80%;
      margin: 20px auto;
      border-collapse: collapse; /* 罫線を重ねてスッキリ表示 */
      text-align: left;
    }

    th, td {
      border: 1px solid #ddd; /* 枠線の色 */
      padding: 8px; /* セル内の余白 */
    }

    th {
      background-color: #f4f4f4; /* ヘッダーの背景色 */
      font-weight: bold; /* 太字 */
      text-transform: uppercase; /* 大文字に変換 */
    }

    tr:nth-child(even) {
      background-color: #f9f9f9; /* 偶数行の背景色 */
    }

    tr:hover {
      background-color: #f1f1f1; /* ホバー時の行の色 */
    }
    
    .hidden {
       display: none;
    }

  </style>

<body>
    <header class="bg-light p-2 z-3 fixed-top" id="header">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="{{ route('admin.group_dashbord') }}" class="mr-auto">
                <img src="{{ asset('img/f-black@4x 1.png') }}" alt="ロゴ">
            </a>
            <ul class="nav-list2 d-flex justify-content-end {{ auth('admin')->check() ? '' : 'hidden' }}" >
                <li class="list-items btn btn-danger"><a href="javascript:void(0);" onclick="confirmLogout()" class="nav-link">ログアウト</a></li>
            </ul>
        </div>
    </header>
    <main id="main-content" ></main>
    
    <div class="container">
        @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

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

    <script>
    window.onload = function() {
        var header = document.getElementById('header');
        var mainContent = document.getElementById('main-content');
        
        // ヘッダーの高さを取得
        var headerHeight = header.offsetHeight;
        
        // メインコンテンツにマージンを設定
        mainContent.style.marginTop = headerHeight + 'px';
    };
    </script>

    @yield('scripts')
</body>
</html>


