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
                    <td>{{ $A->id ?? ''}}</td>
                    <td>{{ $A->name ?? ''}}</td>
                    <td>{{ optional(optional($A)->album)->cover_is_sent === null ? '' : (optional($A)->album->cover_is_sent ? '校了済み' : '未校了') }}</td>
                    <td>{{ optional(optional($A)->album)->body_is_sent === null ? '' : (optional($A)->album->body_is_sent ? '校了済み' : '未校了') }}</td>
                    <td>@if(optional($A)->partner_id === null)
                         <!-- partner_idがnullの場合、リンクを無効にしてスタイル変更 -->
                         <a href="#" style="pointer-events: none; color: gray;">解除不可</a>
                         @else
                         <!-- partner_idがnullでない場合 -->        
                         <a href="#" onclick="event.preventDefault(); document.getElementById('detach-partner-form-A').submit();">解除</a>
                            <form id="detach-partner-form-A" action="{{ route('admin.detachPartner', $A->partner_id) }}" method="POST" style="display: none;">
                            @csrf
                            </form>
                         @endif
                            
                    </td>
                </tr>
                <tr>
                    <td>B</td>
                    <td>{{ $B->id ?? ''}}</td>
                    <td>{{ $B->name ?? ''}}</td>
                    <td>{{ optional(optional($B)->album)->cover_is_sent === null ? '' : (optional($B)->album->cover_is_sent ? '校了済み' : '未校了') }}</td>
                    <td>{{ optional(optional($B)->album)->body_is_sent === null ? '' : (optional($B)->album->body_is_sent ? '校了済み' : '未校了') }}</td>
                    <td> @if(optional($B)->partner_id === null)
                         <!-- partner_idがnullの場合、リンクを無効にしてスタイル変更 -->
                         <a href="#" style="pointer-events: none; color: gray;">解除不可</a>
                         @else
                         <!-- partner_idがnullでない場合 -->
                         <a href="#" onclick="event.preventDefault(); document.getElementById('detach-partner-form-B').submit();">解除</a>
                            <form id="detach-partner-form-B" action="{{ route('admin.detachPartner', $B->partner_id) }}" method="POST" style="display: none;">
                            @csrf
                            </form>
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
            <td>{{ optional($user->album)->cover_is_sent === null ? 'N/A' : (optional($user->album)->cover_is_sent ? '校了済み' : '未校了') }}</td>
            <td>{{ optional($user->album)->body_is_sent === null ? 'N/A' : (optional($user->album)->body_is_sent ? '校了済み' : '未校了') }}</td>
            <td>
                @if ($user->partner_id !== null)
                    <a href="{{ route('admin.showPartner', $user->partner_id) }}" style="color:blue;">{{ $user->partner_id }},</a>
                @else
                    <span>N/A</span>
                @endif
            </td>
            <td>
                @if ($user->template === 'A')
                    @if(optional($B)->id) 
                        <a href="#" onclick="event.preventDefault(); document.getElementById('switch-partner-form-{{ $user->id }}').submit();">A面割り当て{{ $user->id }}</a>
                            <form id="switch-partner-form-{{ $user->id }}" action="{{ route('admin.switchPartner', $B->id) }}" method="POST" style="display: none;">
                                @csrf
                                <input type="hidden" name="new_partner_id" value="{{ $user['id'] }}"> <!-- new_partner_id に渡すID -->
                            </form>
                    @else
                        <a href="#" style="pointer-events: none; color: gray;">割り当て不可</a>
                    @endif
                @else
                    @if(optional($A)->id)
                        <a href="#" onclick="event.preventDefault(); document.getElementById('switch-partner-form-{{ $user->id }}').submit();">B面割り当て{{ $user->id }}</a>
                            <form id="switch-partner-form-{{ $user->id }}" action="{{ route('admin.switchPartner', $A->id) }}" method="POST" style="display: none;">
                                @csrf
                                <input type="hidden" name="new_partner_id" value="{{ $user['id'] }}"> <!-- new_partner_id に渡すID -->
                            </form>
                    @else
                        <a href="#" style="pointer-events: none; color: gray;">割り当て不可</a>
                    @endif
                @endif
            </td>
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