@extends('original_admin.base')

@section('content')

<h1 class="h5">コトバムID:{{ $application->kotobamu->keyword }}</h1>
<h2 class="h6">{{ $application->user->line_display_name }} さんへのメッセージの編集</h2>
<form method="post" action="{{ route('message.update', ['application' => $application, 'message' => $message]) }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="form-group mb-3">
        <label>メッセージ内容</label>
        <textarea class="form-control" name="content">{{ $message->content }}</textarea>
    </div>
    <div class="form-group mb-3">
        <label>音声メッセージURL</label>
        <input type="url" class="form-control" name="audio_url" value="{{ $message->audio_url }}">
    </div>
    <div class="form-group mb-3">
        <label>画像</label>
        <input id="img_message" type="file" class="form-control" name="image" value="{{ $message->image_url }}">
    </div>
    <div class="row">
        @if ($message->image_path)
        <div class="text-center col-6">
            <p>現在の画像</p>
            <img src="{{ asset($message->image_path) }}" style="max-width: 70%">
        </div>
        @endif
        <div class="text-center col-6" id="figure" style="display: none">
            <p>選択した画像</p>
            <img id="figureImage" src="" style="max-width: 70%">
        </div>
    </div>
    <div class="form-group mb-3">
        <label>送信日時</label>
        <input type="datetime-local" name="send_at" class="form-control" step="3600" value="{{ $message->send_at }}">
    </div>
    <input type="submit" value="更新" class="btn btn-success">
</form>

@endsection

@push('scripts')
<script src="{{ asset('js/img_prev.js') }}"></script>
@endpush
