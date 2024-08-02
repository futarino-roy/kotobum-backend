@extends('original_admin.base')

@section('content')

<form action="{{ route('kotobamu.update', $kotobamu) }}" method="post" class="form-group kotobamu_form row">
    @csrf
    @method('PATCH')
    <div class="keyword_input col-6">
        <label class="h6">コトバムキーワード:</label>
        <input type="text" value="{{ $kotobamu->keyword }}" name="keyword" class="form-control">
    </div>
    <div class="done_on_input col-5 offset-1">
        <label class="h6">初回面談日時:</label>
        <input type="date" value="{{ $kotobamu->done_on }}" name="done_on" class="form-control">
    </div>
    <input type="submit" value="更新" class="col-10 offset-1 btn btn-success">
</form>

<br />

<div class="kotobamu_status d-flex justify-content-between">
    @if ($kotobamu->is_open)
    <div class="application_status">
        <p class="badge bg-primary mb-2">申請受付中</p>
        <form action="{{ route('kotobamu.update', $kotobamu) }}" method="post">
            @csrf
            @method('PATCH')
            <input type="hidden" value="0" name="is_open">
            <input type="submit" class="btn m-0 btn-outline-danger" value="申請を受け付けないようにする">
        </form>
    </div>
    @else
    <div class="application_status">
        <p class="badge bg-danger mb-2">新規の申請は受け付けていません</p>
        <form action="{{ route('kotobamu.update', $kotobamu) }}" method="post">
            @csrf
            @method('PATCH')
            <input type="hidden" value="1" name="is_open">
            <input type="submit" class="btn m-0 btn-outline-primary" value="申請を受け付けるようにする">
        </form>
    </div>
    @endif
    <div class="kotobamu_delete_form">
        <form action="{{ route('kotobamu.destroy', $kotobamu) }}" method="post">
            @csrf
            @method('DELETE')
            <input type="submit" class="btn btn-danger" value="このコトバムを削除" onclick='return confirm("コトバムを削除すると、それに紐づくメッセージも削除されます。本当に削除しますか？")'>
        </form>
    </div>
</div>

<hr>

<div class="border border-primary p-3">
    <h2>承認済み</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col" width="10%">アイコン</th>
                <th scope="col" width="20%">LINE名<br><span class="text-primary" style="font-size: 13px;">入力ワード(あれば)</span></th>
                <th scope="col" width="20%">送信メッセージ</th>
                <th scope="col" width="40%">メモ</th>
                <th scope="col" width="10%">申請中に戻す</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($is_approved as $application)
            <tr>
                <td><img src="{{ $application->user->line_picture_url }}" width="30px"></td>
                <td>{{ $application->user->line_display_name }}<br><span class="text-primary" style="font-size: 13px;">{{ $application->input_keyword }}</td>
                <td>
                    @if (count($application->messages))
                    <a href="{{ route('message.create', $application) }}" style="text-decoration: none;" class="link-success border-bottom border-success">メッセージ作成済み</a>
                    @else
                    <a href="{{ route('message.create', $application) }}" style="text-decoration: none;" class="btn btn-outline-danger">メッセージ未作成</a>
                    @endif
                </td>
                <td>
                    <form action="{{ route('application.update', $application) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="メモを入力" value="{{ $application->memo }}" name="memo">
                            <input type="submit" class="btn btn-outline-primary" value="追加">
                        </div>
                    </form>
                </td>
                <td>
                    <form action="{{ route('application.update', $application) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" value="null" name="is_approved">
                        <input type="submit" class="btn btn-outline-secondary" value="戻す">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if(!count($is_approved))
    <p>承認済みのユーザはいません</p>
    @endif
</div>

<br>

<div class="border border-secondary p-3">
    <h2>申請中</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col" width="10%">アイコン</th>
                <th scope="col" width="30%">LINE名<br><span class="text-primary" style="font-size: 13px;">入力ワード(あれば)</span></th>
                <th scope="col" width="30%">承認</th>
                <th scope="col" width="30%">非承認</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($is_applying as $application)
            <tr>
                <td><img src="{{ $application->user->line_picture_url }}" width="30px"></td>
                <td>{{ $application->user->line_display_name }}<br><span class="text-primary" style="font-size: 13px;">{{ $application->input_keyword }}</span></td>
                <td>
                    <form action="{{ route('application.update', $application) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" value="1" name="is_approved">
                        <input type="submit" class="btn btn-outline-primary" value="承認">
                    </form>
                </td>
                <td>
                    <form action="{{ route('application.update', $application) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" value="0" name="is_approved">
                        <input type="submit" class="btn btn-outline-danger" value="非承認">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if(!count($is_applying))
    <p>申請中のユーザはいません</p>
    @endif
</div>

<br>

<form action="{{ route('kotobamu.link_from_followers', $kotobamu) }}" method="GET" class="">
    @csrf
    <div class="form-group">
        <input type="text" name="keyword" placeholder="LINE名で検索" class="border border-secondary" value="{{ $keyword }}">
        <input type="submit" value="検索" class="border border-success">
    </div>
</form>

<div class="border border-primary p-3">
    <h2>フォロワー一覧<p class="h6">デフォルトでは10名のみ表示</p>
    </h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col" width="20%">アイコン</th>
                <th scope="col" width="50%">LINE名</th>
                <th scope="col" width="30%">追加</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($followers as $follower)
            <tr>
                @if ($follower->line_picture_url)
                <td><img src="{{ $follower->line_picture_url }}" width="30px"></td>
                @else
                <td>-</td>
                @endif
                <td>{{ $follower->line_display_name }}</td>
                <td>
                    <form action="{{ route('application.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $follower->id }}">
                        <input type="hidden" name="kotobamu_id" value="{{ $kotobamu->id }}">
                        <input type="submit" class="btn btn-outline-secondary" value="このユーザを追加する">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@push('styles')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endpush
