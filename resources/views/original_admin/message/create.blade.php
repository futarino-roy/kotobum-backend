@extends('original_admin.base')

@section('content')

<h1 class="h5">コトバム名:{{ $application->kotobamu->keyword }}</h1>
<h2 class="h6">{{ $application->user->line_display_name }} さんへのメッセージの追加</h2>
<form class="mt-3" method="post" action="{{ route('message.store', $application) }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group mb-3">
        <label>送信テキスト(必須)</label>
        <textarea class="form-control" name="content">{{ old('content') }}</textarea>
    </div>
    <div class="form-group mb-3">
        <label>音声メッセージURL</label>
        <input type="url" class="form-control" name="audio_url" value="{{ old('audio_url') }}">
    </div>
    <div class="form-group mb-3">
        <label>画像</label>
        <input id="img_message" type="file" class="form-control" name="image">
    </div>
    <div class="text-center" id="figure" style="display: none">
        <img id="figureImage" src="" width="300px">
    </div>
    <div class="form-group mb-3">
        <label>送信日時(必須)</label>
        <input type="datetime-local" name="send_at" class="form-control" step="3600" value="{{ old('send_at') }}">
    </div>
    <input type="submit" value="登録" class="btn btn-primary">
</form>

<div class="border border-primary p-3 m-3">
    <h2 class="h6">{{ $application->user->line_display_name }} さんに送信予定のメッセージ</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">メッセージテキスト</th>
                <th scope="col">音声URL</th>
                <th scope="col">画像</th>
                <th scope="col">送信日時</th>
                <th scope="col">編集</th>
                <th scope="col">削除</th>
                <th scope="col">送信状況</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($messages as $message)
            <tr>
                <td>{!! nl2br(e($message->content)) !!}</td>
                <td><a href="{{ $message->audio_url }}">{{ $message->audio_url }}</a></td>
                <td>
                    @if ($message->image_path === "削除済み")
                    {{ $message->image_path }}
                    @elseif ($message->image_path)
                    <img src="{{ asset($message->image_path) }}" width="100px" data-src="{{ asset($message->image_path) }}" class="message_img">
                    @else
                    なし
                    @endif
                </td>
                <td>{{ $message->send_at }}</td>
                @if (is_future_message($message->id))
                <td><a href="{{ route('message.edit', ['application' => $application, 'message' => $message]) }}" class="btn btn-outline-success">メッセージの編集</a></td>
                <td>
                    <form action="{{ route('message.destroy', ['application' => $application, 'message' => $message]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger btn-sm" value="削除">
                    </form>
                </td>
                @else
                <td colspan="2">送信日時を過ぎています</td>
                @endif
                <td>
                    @if ($message->is_sent === true)
                        成功しました
                    @elseif ($message->is_sent === false)
                        失敗しました
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if(!count($messages))
    <p>送信予定のメッセージはありません</p>
    @endif
    <a href="https://chat.line.biz/Ufd41b30d933126e41bec97d10f51c003" target="_blank" rel="noopener noreferrer">LINE Official Account Managerのチャット画面を開く</a>
</div>


<!-- 画像拡大表示用のモーダル -->
<div class="modal-wrapper">
    <img src="" alt="" class="modal-image">
</div>

@endsection

@push('styles')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{ asset('js/img_prev.js') }}"></script>
<script src="{{ asset('js/modal.js') }}"></script>
@endpush
