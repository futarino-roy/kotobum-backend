<!-- resources/views/admin/partner.blade.php -->
@extends('admin.base')

@section('title', 'パートナーダッシュボード')

@section('content')
    <h1>フタリノ状況確認</h1>

    <h2 style="margin-left:10%;">フタリノ状況</h2>
    <table border="1">
        <thead>
            <tr>
                <th></th>
                <th>ID</th>
                <th>名前</th>
                <th>表紙校了</th>
                <th>中身校了</th>
                <th>結びつけ解除</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>A</td>
                    <td>{{ $A->id ?? 'N/A'}}</td>
                    <td>{{ $A->name ?? 'N/A'}}</td>
                    <td>{{ $A->album->cover_is_sent ?? 'N/A'}}</td>
                    <td>{{ $A->album->body_is_sent ?? 'N/A'}}</td>
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
                    <td>{{ $B->id ?? 'N/A'}}</td>
                    <td>{{ $B->name ?? 'N/A'}}</td>
                    <td>{{ $B->album->cover_is_sent ?? 'N/A'}}</td>
                    <td>{{ $B->album->body_is_sent ?? 'N/A'}}</td>
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
                @if ($user->id == optional($A)->id || $user->id == optional($B)->id)
                    @continue
                @endif
        <tr>
            <td>{{ $user->template }}</td>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->album->cover_is_sent ?? N/A }}</td>
            <td>{{ $user->album->body_is_sent ?? N/A }}</td>
            <td>
                @if (!is_null($A->partner_id))
                    <a href="{{ route('admin.showPartner', $A->partner_id) }}" style="color:blue;">{{ $user->partner->name }}</a>
                @else
                    <span style="color: gray;">N/A</span>
                @endif
            </td>
            <td><a href="#" style="pointer-events: none; color: gray;">割り当て</a></td>
            <td><a href="{{ route('admin.showPartner', $user->id) }}">移動</a></td>
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