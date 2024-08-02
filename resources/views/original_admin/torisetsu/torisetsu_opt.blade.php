@extends('original_admin.base')

@section('content')
<!-- <div class="navbar">
        <div class="logo">フタリノ トリセツ</div>
        <ul class="nav-menu">
            <li><a href="{{ route('torisetsu_users') }}">ユーザー一覧</a></li>
            <li><a href="{{ route('torisetsu_opt') }}">トリセツ自動作成</a></li>
        </ul>
    </div> -->
<div class="container-fluid">
    <h2>トリセツ自動作成</h2>
    <div class="how_to alert alert-primary" role="alert">
        <h2>使い方</h2>
        <ol style="list-style-type: decimal;">
            <li>以下のフォームでエクセル(xlsx)ファイルを選択します</li>
            <li>フォームの下に画像のイメージが表示されます</li>
            <li>確認後、最下部にある「画像を保存」ボタンをクリックします</li>
            <li>
                ダウンロードフォルダに「sheet_{ペア番号}.png」という名前でダウンロードされます
                <br>
                同じペア番号が複数ある場合、2人目以降は後ろに「_pair」とついたファイル名で保存されます<br>（例: 「sheet_123」「sheet_123_pair」「sheet_123_pair_pair」）
            </li>
        </ol>
        <p>※Chrome以外のブラウザだとうまくいかない可能性があります</p>
        <p>※連続して使用する場合は一度リロードしてからファイルをアップしてください</p>
    </div>
    <div class="custom-file" id="custom-file">
        <input type="file" class="custom-file-input" id="customFile" accept=".xlsx">
        <label class="custom-file-label" for="customFile">Excelファイルを選択...</label>
    </div>
    <div id="sheet_list"></div>
    <br>
    <button class="btn btn-success" data-role="saveimage">画像を保存</button>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.11.19/xlsx.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dom-to-image@2.6.0/dist/dom-to-image.min.js"></script>
<script src="{{ asset('js/optimize.js') }}" defer></script>
<script src="{{ asset('js/create_image.js') }}" defer></script>
@endpush

@push('styles')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link href="{{ asset('css/torisetsu_opt.css') }}" rel="stylesheet">
@endpush
