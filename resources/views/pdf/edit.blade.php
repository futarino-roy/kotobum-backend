<!-- resources/views/pdf/edit.blade.php -->
@extends('admin.base')

@section('title', 'PDF編集')

@section('content')
    <h1>PDF化確認ページ</h1>

    <form action="{{ route('admin.PDF') }}" method="POST" id="html-form">
     @csrf
     <label for="html-content">HTMLコードを編集してください:</label><br><br>

        <!-- 編集可能なテキストエリア（動的に埋め込むテンプレートをここに表示）-->
        <textarea id="html-content" name="html_content">
            <!-- @include('format.' . $format) --> <!-- 動的にテンプレートを切り替え -->
        </textarea><br><br>

     <button type="submit">PDFを生成</button>
    </form>

    <h2>プレビュー</h2>
    <div id="preview"></div>

    <script>
        document.getElementById('html-content').addEventListener('input', function() {
            var htmlContent = document.getElementById('html-content').value;
         document.getElementById('preview').innerHTML = htmlContent;
        });
    </script>
@endsection
