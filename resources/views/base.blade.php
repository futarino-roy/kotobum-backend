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
    <footer class="footer bg-dark text-center text-light p-2 z-3 fixed-bottom" style=" vertical-align: center;">
        管理者用サイト.
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