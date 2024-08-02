<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>コトバム管理画面</title>
    <link rel="stylesheet" href="{{ asset('assets/css/base.css')  }}" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@1.0.15/destyle.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    @stack('styles')
</head>

<body>
    <header class="header">
        <div class="navbar1">
            <div class="logo1">
                <a class="nav-link" href="{{ route('kotobamu.index') }}">コトバム管理者サイト</a>
            </div>
            @auth('original_admins')
            <ul class="nav-list1">
                <div class="dropdown">
                    <button class=" dropdown-toggle" style="width: 130px; height: 60px" type="button" data-bs-toggle="dropdown" aria-expanded="false">未来へのメッセージ</button>
                    <ul class="dropdown-menu">
                        <li class="list-items dropdown-item"><a href="{{ route('kotobamu.index') }}" class="nav-link">ユーザ管理</a></li>
                        <li class="list-items dropdown-item"><a href="{{ route('application.denials') }}" class="nav-link">非承認した申請一覧</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <button class=" dropdown-toggle" style="width: 200px; height: 60px" type="button" data-bs-toggle="dropdown" aria-expanded="false">トリセツ関連</button>
                    <ul class="dropdown-menu">
                        <li class="list-items dropdown-item"><a href="{{ route('torisetsu_users') }}"  class="nav-link">顧客管理</a></li>
                        <li class="list-items dropdown-item"><a href="{{ route('torisetsu_opt') }}" class="nav-link">自動トリセツ作成</a></li>
                    </ul>
                </div>
            </ul>
            <ul class="nav-list2">
                <li class="list-items btn btn-warning"><a href="{{ route('user_admin') }}" class="nav-link">管理者</a></li>
                <li class="list-items btn btn-danger"><a href="javascript:void(0);" onclick="confirmLogout()" class="nav-link">ログアウト</a></li>
            </ul>
            @endauth
            @guest('original_admins')
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('original_admin.login_form') }}" class="nav-link">ログイン</a></li>
            </ul>
            @endguest
        </div>
    </header>
    <div class="container mb-5">
        @if (session('success'))
        <p class="alert alert-success" role="alert">{{ session('success') }}</p>
        @endif

        @if ($errors->any())
        <div>
            <ul class="alert alert-warning" role="alert">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @yield('content')
    </div>
    <footer class="footer bg-dark text-center text-light p-2 z-3 fixed-bottom" style=" vertical-align: center;">
        公式LINE管理者用サイト.
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
    function confirmLogout() {
        if (confirm('ログアウトしてもよろしいですか？')) {
            window.location.href = "{{ route('original_admin.logout') }}";
        }
    }
</script>
    @stack('scripts')
</body>

</html>
