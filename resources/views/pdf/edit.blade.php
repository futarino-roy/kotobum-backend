<!-- resources/views/pdf/edit.blade.php -->
@extends('admin.base')

@section('title', 'PDF編集')

@section('content')
    <h1>PDF化確認ページ</h1>

    <form action="{{ route('admin.PDF') }}" method="POST" id="html-form" target="_blank">
     @csrf
     <label for="html-content">HTMLコードを編集してください:</label><br><br>

        <!-- 編集可能なテキストエリア（動的に埋め込むテンプレートをここに表示）-->
        <textarea id="html-content" name="html_content" style="width: 100%;">
                 @include('pdf.format.' . $format, [
                    'textdata' => $textData,
                    'colors' => $colors,
                    'imageData' => $imageData
                    ])
        </textarea><br><br>

     <button type="submit">PDFを生成</button>
    </form>

    <h3>プレビューエリア</h3>
    <iframe id="preview"></iframe>

    <script>
        document.getElementById('html-content').addEventListener('input', function() {
            var htmlContent = document.getElementById('html-content').value;
            var iframe = document.getElementById('preview');
            var iframeDocument = iframe.contentDocument || iframe.contentWindow.document;

            // iframe内の内容を更新
            iframeDocument.open();
            iframeDocument.write(htmlContent);
            iframeDocument.close();
        });
    </script>
@endsection
