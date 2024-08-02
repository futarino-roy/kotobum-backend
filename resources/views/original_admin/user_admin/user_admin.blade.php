@extends('original_admin.base')

@section('content')


<div class="border border-primary p-3">
    <h2>管理者一覧</h2>
    <table class="table" id="addedUsersTable">
        <thead>
            <tr>
                <th scope="col" width="20%">アイコン</th>
                <th scope="col" width="50%">LINE名</th>
                <th scope="col" width="30%">管理者</th>
            </tr>
        </thead>
        <tbody>
        <tbody class="table-group-divider">
            @foreach ($admin_users as $user)
            <tr>
                @if ($user->line_picture_url)
                <td><img src="{{ $user->line_picture_url }}" width="30px"></td>
                @else
                <td>-</td>
                @endif
                <td>{{ $user->line_display_name }}</td>
                <td>
                    <form action="{{ route('remove_admin', $user) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <input type="submit" class="btn m-0 btn-outline-primary" value="管理者から削除">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        </tbody>
    </table>
</div>

<br><br>

<form action="{{ route('user_admin') }}" method="GET" class="">
    @csrf
    <div class="form-group">
        <input type="text" name="keyword" placeholder="LINE名で検索" class="border border-secondary" value="{{ request('keyword') }}">
        <input type="submit" value="検索" class="border border-success">
    </div>
</form>
<div class="border border-primary p-3">
    <h2>LINEユーザ一覧</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col" width="20%">アイコン</th>
                <th scope="col" width="50%">LINE名</th>
                <th scope="col" width="30%">追加</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($lineUsers as $user)
            <tr>
                @if ($user->line_picture_url)
                <td><img src="{{ $user->line_picture_url }}" width="30px"></td>
                @else
                <td>-</td>
                @endif
                <td>{{ $user->line_display_name }}</td>
                <td>
                    
                    <form action="{{ route('admin_store') }}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <input type="submit" class="btn btn-outline-secondary" value="管理者に追加する">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
