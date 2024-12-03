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
                    <td>{{ $A->id ?? 'N/A'}}</td>
                    <td>{{ $A->name ?? 'N/A'}}</td>
                    <td>{{ $A->Album->cover_is_send ?? 'N/A'}}</td>
                    <td>{{ $A->Album->body_is_send ?? 'N/A'}}</td>
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
                    <td>{{ $B->Album->cover_is_send ?? 'N/A'}}</td>
                    <td>{{ $B->Album->body_is_send ?? 'N/A'}}</td>
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