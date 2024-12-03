<!-- resources/views/admin/partner.blade.php -->
@extends('admin.base')

@section('title', 'パートナーダッシュボード')

@section('content')
    <h1>フタリノ状況確認</h1>

    <h2 style="margin-left:10%;">フタリノ状況</h2>
    <table border="1">
        <thead>
            <tr>
                <th>A面B面</th>
                <th>ID</th>
                <th>名前</th>
                <th>表紙校了</th>
                <th>中身校了</th>
                <th>結びつけ削除</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>A</td>
                    <td>{{ $A->id }}</td>
                    <td>{{ $A->name }}</td>
                    <td>{{ $A->Album->cover_is_send }}</td>
                    <td>{{ $A->Album->body_is_send }}</td>
                    <td>@if(is_null($A->partner_id))
                         <!-- partner_idがnullの場合、リンクを無効にしてスタイル変更 -->
                         <a href="#" style="pointer-events: none; color: gray;">結びつけ解除不可</a>
                         @else
                         <!-- partner_idがnullでない場合 -->        
                         <a href="{{ route('admin.showPartner', $A->partner_id) }}">結びつけ解除</a>
                         @endif
                            
                    </td>
                </tr>
                <tr>
                    <td>B</td>
                    <td>{{ $B->id }}</td>
                    <td>{{ $B->name }}</td>
                    <td>{{ $B->Album->cover_is_send }}</td>
                    <td>{{ $B->Album->body_is_send }}</td>
                    <td> @if(is_null($A->partner_id))
                         <!-- partner_idがnullの場合、リンクを無効にしてスタイル変更 -->
                         <a href="#" style="pointer-events: none; color: gray;">結びつけ解除不可</a>
                         @else
                         <!-- partner_idがnullでない場合 -->
                         <a href="{{ route('admin.showPartner', $A->partner_id) }}">結びつけ解除</a>
                         @endif 
                    </td>
                </tr>
        </tbody>
    </table>

    <h2 style="margin-left:10%;">他ユーザー</h2>
    <table border="1">
        <thead>
            <tr>
                <th>A面B面</th>
                <th>ID</th>
                <th>名前</th>
                <th>表紙校了</th>
                <th>中身校了</th>
                <th>パートナー</th>
                <th>割り当て</th>
                <th>ページ移動</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                @if ($user->id == $A->id || $user->id == $B->id)
                    @continue
                @endif
        <tr>
            <td>{{ $user->template }}</td>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->cover_is_send }}</td>
            <td>{{ $user->body_is_send }}</td>
            <td><a href="{{ route('admin.showPartner', $A->partner_id) }}">割り当て</a></td>
            <td><a href="{{ route('admin.showPartner', $A->partner_id) }}">移動</a></td>
        </tr>
    @endforeach
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