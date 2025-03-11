<!-- resources/views/admin/dashboard.blade.php -->
@extends('admin.base')

@section('title', 'ユーザー詳細ページ')

@section('content')
    @php
        $naCountA = 0;
        $naCountB = 0;
    @endphp

    @if(!empty($imageDataA))
        @foreach ($imageDataA as $imageA)
        @php 
            if (!isset($imageA->image)) $naCountA++; 
        @endphp
        @endforeach
    @endif
    @if(!empty($imageDataB))
        @foreach ($imageDataB as $Bimage)
        @php 
            if (!isset($imageB->image)) $naCountB++; 
        @endphp
        @endforeach
    @endif

    <h1 style="margin-left:10%;">{{ $group->name }} グループ 詳細ページ</h1>

    <h2 style="margin-left:10%;">基本情報</h2>

    <table border="1">
        <tbody>
            <tr>
                <th>校了状態:両方済み</td>
                <th>FMT:{{ $group->format }}</th>
                <th>表紙編集</th>
                <th><a href="{{ route('admin.delete_group', $group->id) }}"
                    onclick="return confirm('本当に削除しますか？この操作は取り消せません。')"
                    style="color: red;">全体データ削除</a>
                </th>
            </tr>
        </tbody>
    </table>


    <table border="1">
        <thead>
            <tr>
                <th></th>
                <th>ID</th>
                <th>名前</th>
                <th>最終更新時間</th>
                <th>未格納画像数</th>
                <th>校了状態</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>A面</th>
                <th>{{ $group->Auser->id ?? 'N/A'}}</th>
                <th>{{ $group->Auser->name ?? 'N/A' }}</th>
                <th>{{ $group->Auser->updated_at ?? 'N/A' }}</th>
                <th>{{ $naCountA }}</th>
                <th>{{ $group->Auser?->Album?->body_is_sent ? '校了済み' : '未校了' }}</th>
                <th>
                    @if($group->Auser)
                        <a href="{{ route('admin.user_infomation', $group->Auser->id) }}">詳細</a>
                    @else
                        詳細
                    @endif
                </th>
                <th>
                    @if($group->Auser)
                        <a href="{{ route('admin_user_redirect', ['userid' => $group->Auser->id, 'parts' => 'body']) }}" target="_blank">編集</a>
                    @else
                        編集
                    @endif
                </th>
                <th>
                    @if($group->Auser)
                        <a href="{{ route('admin.delete_user', ['userid' => $group->Auser->id]) }}"
                        onclick="return confirm('本当に削除しますか？この操作は取り消せません。')"
                        style="color: red;">削除</a>
                    @else
                        削除
                    @endif
                </th>
            </tr>
            <tr>
                <th>B面</th>
                <th>{{ $group->Buser->id ?? 'N/A' }}</th>
                <th>{{ $group->Buser->name ?? 'N/A' }}</th>
                <th>{{ $group->Buser->updated_at ?? 'N/A' }}</th>
                <th>{{ $naCountB }}</th>
                <th>{{ $group->Buser?->Album?->body_is_sent ? '校了済み' : '未校了' }}</th>
                <th>
                    @if($group->Buser)
                        <a href="{{ route('admin.user_infomation', $group->Buser->id) }}">詳細</a>
                    @else
                        詳細
                    @endif
                </th>
                <th>
                    @if($group->Buser)
                        <a href="{{ route('admin_user_redirect', ['userid' => $group->Buser->id, 'parts' => 'body']) }}" target="_blank">編集</a>
                    @else
                        編集
                    @endif
                </th>
                <th>
                    @if($group->Buser)
                        <a href="{{ route('admin.delete_user', ['userid' => $group->Buser->id]) }}"
                        onclick="return confirm('本当に削除しますか？この操作は取り消せません。')"
                        style="color: red;">削除</a>
                    @else
                        削除
                    @endif
                </th>
            </tr>
            </tr>
        </tbody>
    </table>


    <hr>

    <h3>ユーザー作成 B→A</h3>
    <form action="{{ route('admin.create_user', $group->id) }}" method="POST">
        @csrf
        <input type="hidden" name="group_id" value="{{ $group->id }}">
        <input type="hidden" name="format" value="{{ $group->format }}">
        <div class="mb-3">
            <label for="name" class="form-label">名前</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="login_id" class="form-label">ログインID</label>
            <input type="text" class="form-control" id="login_id" name="login_id" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">パスワード（八桁）</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">ユーザー作成</button>
    </form>

    <!-- テキストデータ表と画像票のレイアウトは検討　ページごとという案もある -->


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