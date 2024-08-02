@extends('original_admin.base')

@section('content')


@php
    $totalUsers = count($baseQuery);
    $totalUsersWithTorisetsu = 0;
    $totalDisplayedUsers = 0;
    foreach ($baseQuery as $user) {
        $totalDisplayedUsers++;
        if ($user->torisetsus->count() > 0) {
            $totalUsersWithTorisetsu++;
        }
    }
@endphp


<head>
    <title>torisetsu_users</title>
    <link rel="stylesheet" href="{{ asset('assets/css/torisetsu_users.css') }}" >
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
    <!-- <div class="navbar">
        <div class="logo">フタリノ トリセツ</div>
        <ul class="nav-menu">
            <li><a href="{{ route('torisetsu_users') }}">ユーザー一覧</a></li>
            <li><a href="{{ route('torisetsu_opt') }}">トリセツ自動作成</a></li>
        </ul>
    </div> -->
    <div class="main">
        <div class="table">
            <div class="table-header">
                <h2>登録したユーザー一覧表</h2>
                    <p>合計登録ユーザー数: {{ $totalUsers }}</p>
                    <p>トリセツを作成したユーザー数: {{ $totalUsersWithTorisetsu }}</p>
            </div>
            <form action="{{ route('torisetsu_users') }}" method="GET" class="form">
                <div class="form-group date">
                    <label for="date-filter" class="date-filter-label">ユーザー登録日付 :</label>
                    <input type="month" name="date" id="date-filter" class="date-filter" value="{{ Request::get('date') ?? 'date' }}">
                </div>

                <div class="form-group date">
                    <label for="latest_torisetsu_date" class="date-filter-label">作成日付 :</label>
                    <input type="month" name="latest_torisetsu_date" id="latest_torisetsu_date" class="date-filter" value="{{ Request::get('latest_torisetsu_date') ?? 'latest_torisetsu_date' }}">
                </div>

                <!-- 誕生日での検索 -->
                <div class="form-group birthday-filter">
                    <label for="birthday-filter" class="birthday-filter-label">誕生日 :</label>
                    <input type="month" name="birthday" id="birthday-filter" class="birthday-filter" value="{{ Request::get('birthday') ?? 'birthday' }}">
                </div>


                
                <!-- 名前での検索 -->
                <div class="form-group name-filter">
                <label for="gender-filter" class="gender-filter-label">名前：</label>
                    <input type="text" name="name" id="name-filter" placeholder="名前" class="name-filter" value="{{ Request::get('name') ?? old('name') }}">
                </div>

                <!-- ラインの名前での検索 -->
                <div class="form-group line_display_name">
                <label for="gender-filter" class="gender-filter-label">LINE_name：</label>
                    <input type="text" name="line_display_name" id="line_display_name" placeholder="ラインの名前" class="line_display_name" value="{{ Request::get('line_display_name') ?? old('line_display_name') }}">
                </div>


                <div class="form-group gender-filter">
                    <label for="gender-filter" class="gender-filter-label">性別:</label>
                    <select name="gender" id="gender-filter" class="gender-filter">
                        <option value="" {{ Request::get('gender') === '' ? 'selected' : '' }}>全て</option>
                        <option value="1" {{ Request::get('gender') === '1' ? 'selected' : '' }}>女性</option>
                        <option value="2" {{ Request::get('gender') === '2' ? 'selected' : '' }}>男性</option>
                        <option value="3" {{ Request::get('gender') === '3' ? 'selected' : '' }}>回答しない</option>
                    </select>
                </div>


                <div class="form-group state-filter">
                    <label for="state-filter" class="state-filter-label">交際状況 :</label>
                    <select name="state" id="state-filter" class="state-filter">
                        <option value="" {{ Request::get('state') === '' ? 'selected' : '' }}>全て</option>
                        <option value="1" {{ Request::get('state') === '1' ? 'selected' : '' }}>結婚中</option>
                        <option value="2" {{ Request::get('state') === '2' ? 'selected' : '' }}>婚約中</option>
                        <option value="3" {{ Request::get('state') === '3' ? 'selected' : '' }}>既婚</option>
                        <option value="4" {{ Request::get('state') === '4' ? 'selected' : '' }}>その他</option>
                    </select>
                </div>


                <button type="submit" class="button">検索</button> 
            </form>
            
            <div class="table-body">
                <table>

                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> ユーザー登録日付 </th>
                            <th> 最終作成日付 </th>
                            <th> LINE_Name </th>
                            <th> 名前 </th>
                            <th> 性別 </th>
                            <th> 交際状況 </th>
                            <th> 誕生日 </th>
                            <th> 回数 </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($baseQuery as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->created_at->toDateString() }}</td>
                            <td>{{ optional($user->torisetsus->last())->updated_at ? $user->torisetsus->last()->updated_at->toDateString() : 'NULL' }}</td>
                            <td>{{ $user->line_display_name }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                @if ($user->gender === 1)
                                    女性
                                @elseif ($user->gender === 2)
                                    男性
                                @elseif ($user->gender === 3)
                                    回答しない
                                @endif
                            </td>
                            <td>
                                @if ($user->state === 1)
                                    交際中
                                @elseif ($user->state === 2)
                                    婚約中
                                @elseif ($user->state === 3)
                                    既婚
                                @elseif ($user->state === 4)
                                    その他
                                @endif
                            </td>
                            <td>{{ $user->birthday }}</td>
                            <td>{{ $user->torisetsus->count()  ?? 0 }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

@endsection


