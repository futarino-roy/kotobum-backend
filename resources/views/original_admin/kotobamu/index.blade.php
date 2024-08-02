@extends('original_admin.base')

@section('content')

<form method="post" action="{{ route('kotobamu.store') }}">
    @csrf
    <div class="form-group">
        <label>コトバムキーワード</label>
        <input class="form-control" type="text" name="keyword" min="1" value="{{ old('keyword') }}">
    </div>
    <div class="form-group">
        <label>初回面談日時</label>
        <input class="form-control" type="date" name="done_on" value="{{ old('done_on') }}">
    </div>
    <input type="submit" value="登録" class="btn btn-primary">
</form>

<hr>
<!-- コトバムの検索 -->
<form action="{{ route('kotobamu.index') }}" method="GET" class="">
    @csrf
    <div class="form-group">
        <input type="text" name="keyword" placeholder="コトバム名で検索" class="border border-secondary" value="{{ $keyword }}">
        <input type="submit" value="検索" class="border border-success">
    </div>
</form>

<h5>メッセージ未設定のコトバム</h5>
<table class="table table-danger table-bordered">
    <thead>
        <tr>
            <th scope="col" width="50%">キーワード<br><span class="text-primary" style="font-size: 13px;">初回面談日時</span></th>
            <th scope="col" width="30%">状態</th>
            <th scope="col" width="20%">詳細</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        @foreach ($no_message_kotobamus as $kotobamu)
        <tr>
            <td>{{ $kotobamu->keyword }}<br><span class="text-primary" style="font-size: 13px;">{{ $kotobamu->done_on }}</span></td>
            @if($kotobamu->is_open)
            <td>申請受付中</td>
            @else
            <td>申請を受け付けていません</td>
            @endif
            <td><a href="{{ route('kotobamu.link_from_followers', $kotobamu) }}">詳細</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

<hr>

<h5>メッセージ設定済みのコトバム</h5>
<table class="table table-secondary table-bordered">
    <thead>
        <tr>
            <th scope="col" width="50%">キーワード<br><span class="text-primary" style="font-size: 13px;">初回面談日時</span></th>
            <th scope="col" width="30%">状態</th>
            <th scope="col" width="20%">詳細</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        @foreach ($has_message_kotobamus as $kotobamu)
        <tr @if(!messages_created($kotobamu->id)) class="table-danger" @endif>
            <td>{{ $kotobamu->keyword }}<br><span class="text-primary" style="font-size: 13px;">{{ $kotobamu->done_on }}</span></td>
            @if($kotobamu->is_open)
            <td>申請受付中</td>
            @else
            <td>申請を受け付けていません</td>
            @endif
            <td><a href="{{ route('kotobamu.link_from_followers', $kotobamu) }}">詳細</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

<hr>

@php
use Carbon\CarbonImmutable;
$today = CarbonImmutable::today();
@endphp

<div class="row">
    <div class="col-4">
        <h5>送信予定メッセージ総数</h5>
        <small>(200通を超える月は課金or一部手動での送信が必要)</small>
        <table class="table table-info table-bordered">
            <thead>
                <tr>
                    <th scope="col">今月({{ $today->month }}月)</th>
                    <th scope="col">来月({{ $today->addMonths(1)->month }}月)</th>
                    <th scope="col">{{ $today->addMonths(2)->month }}月</th>
                    <th scope="col">{{ $today->addMonths(3)->month }}月</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ message_count() }}</td>
                    <td>{{ message_count(1) }}</td>
                    <td>{{ message_count(2) }}</td>
                    <td>{{ message_count(3) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
