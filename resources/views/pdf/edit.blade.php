<!-- resources/views/pdf/edit.blade.php -->
@extends('admin.base')

@section('title', 'PDF編集')

@section('content')
    <h1>PDF化確認ページ</h1>

    <form action="{{ route('admin.PDF') }}" method="POST" id="html-form" target="_blank">
     @csrf
     <label for="html-content">HTMLコードを編集してください:</label><br><br>

        <!-- 編集可能なテキストエリア（動的に埋め込むテンプレートをここに表示）-->
        <textarea id="html-content" name="html_content" style="width: 100%; height: 500px">
                 @include('pdf.format.' . $format, [
                    'textdata' => $textData,
                    'colors' => $colors,
                    'imageData' => $imageData
                    ])
        </textarea><br><br>

     <button type="submit">PDFを生成</button>
    </form>

    <!-- <img src="{{ asset('img/kotobum_format1/p1@2x.jpg') }}" alt=""> -->

    <!-- <div style="display: grid; place-items: center; margin-top: 50px">
        <h3>プレビューエリア</h3>
        <iframe id="preview" style="width: 158mm; height: 600px;"></iframe>
    </div> -->

    <script>
  /*       document.getElementById('html-content').addEventListener('input', function() {
            var htmlContent = document.getElementById('html-content').value;
            var iframe = document.getElementById('preview');
            var iframeDocument = iframe.contentDocument || iframe.contentWindow.document;

            // iframe内の内容を更新
            iframeDocument.open();
            iframeDocument.write(htmlContent);
            iframeDocument.close();
        }); */
    </script>
@endsection
