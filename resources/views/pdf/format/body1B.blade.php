<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <title>PDFテンプレートinside</title>
  <style>
    /* ローカルフォントを使う例 */
    @font-face {
      font-family: 'Zen Maru Gothic';
      src: url('./fonts/ZenMaruGothic-Regular.ttf') format('truetype');
    }

    @font-face {
      font-family: 'League Spartan';
      src: url('./fonts/LeagueSpartan-Regular.ttf') format('truetype');
    }

    body {
      font-family: 'Zen Maru Gothic', sans-serif;
      margin: 0;
      padding: 0;
    }

    .content {
      text-align: center;
      margin: 20px auto;
      max-width: 800px;
    }

    .swiper-slide_box {
      border: 1px solid #ddd;
      padding: 20px;
      margin: 10px 0;
      position: relative;
    }

    .input-drop {
      position: absolute;
      width: 100%;
      height: 99%;
      top: 0;
      text-align: center;
      /* 水平方向の中央揃え */
    }

    .droparea {
      border: 2px solid #ccc;
      border-radius: 10%;
      position: absolute;
      top: 50%;
      /* 縦方向の中央 */
      left: 50%;
      /* 水平方向の中央 */
      transform: translate(-50%, -50%);
      /* 中央揃え */
      /* サーバーから取得 */
      width: 30%;
      height: 35%;
      /* ーーーーーーーー */
    }

    .textarea {
      /* margin: 5% 0 4%; */
      position: relative;
    }

    .img {
      position: relative;
    }

    img {
      border: 1px solid #ddd;
    }

    .uniqueColor {
      background-color: pink;
      /* width: 75.3%; */
    }

    .text-empty {}

    .text-color {}

    .empty {}

    /* ーーー　1ページ　ーーー */
    #dropArea1 {}

    #textArea1-1 {
      font-family: 'League Spartan', sans-serif;
      margin: 30px 0 0 0;
      font-size: 1.2rem;
      line-height: 1.2;
      font-weight: bold;
      text-align: center;
      top: 19%;
    }

    #textArea1-2 {
      font-family: 'League Spartan', sans-serif;
      margin: 0;
      font-size: 0.45rem;
      text-align: center;
      line-height: 1.5;
      font-weight: bold;
      top: 22%;
    }

    #textArea1-3 {
      text-align: center;
      top: 63%;
    }

    /* ーーー　2ページ　ーーー */
    #dropArea2 {}

    #textArea2 {
      font-size: 0.6rem;
      line-height: 1.5;
      font-weight: bold;
      text-align: center;
      top: 28%;
    }

    /* ーーー　3ページ　ーーー */
    #textArea3,
    #textArea5,
    #textArea7,
    #textArea9 {
      top: 30%;
      left: 31.5%;
      font-size: 8pt;
      max-width: 38%;
      text-align: left;
    }

    /* ーーー　4ページ　ーーー */
    #textArea4-1 {
      font-size: 0.6rem;
      line-height: 1.5;
      font-weight: bold;
      color: #fef8f6;
      text-align: center;
      top: 28%;
    }

    #textArea4-2 {
      font-size: 0.6rem;
      line-height: 1.5;
      font-weight: bold;
      color: #fef8f6;
      text-align: center;
      top: 69%;
    }

    #dropArea4 {}

    /* ーーー　5ページ　ーーー */
    /* ーーー　6ページ　ーーー */
    #textArea6-1 {
      font-size: 0.6rem;
      line-height: 1.5;
      font-weight: bold;
      text-align: center;
      top: 26%;
    }

    #dropArea6 {}

    /* ーーー　7ページ　ーーー */
    /* ーーー　8ページ　ーーー */
    #textArea8 {
      font-size: 0.6rem;
      line-height: 1.5;
      font-weight: bold;
      text-align: center;
      color: #fef8f6;
      top: 27%;
    }

    #dropArea8 {}

    /* ーーー　9ページ　ーーー */
    /* ーーー　10ページ　ーーー */
    #textArea10 {
      font-size: 0.6rem;
      line-height: 1.5;
      font-weight: bold;
      text-align: center;
      top: 27%;
    }

    #dropArea10 {}

    /* ーーー　11ページ　ーーー */
    #textArea11-1 {
      font-family: 'League Spartan', sans-serif;
      min-width: 60%;
      margin-bottom: 5%;
      margin-top: 5%;
      font-size: 0.7rem;
      line-height: 1.5;
      font-weight: bold;
      text-align: center;
      top: 17%;
    }

    #textArea11-2 {
      min-height: 50%;
      max-height: 30%;
      margin-bottom: 2.5%;
      margin-top: 2.5%;
      font-size: 0.33rem;
      top: 17%;
    }

    /* ーーー　12ページ　ーーー */
    #textArea12-2 {
      height: 35% !important;
      font-size: 0.25rem;
      width: 27%;
      top: 20.3%;
      left: 26%;
    }

    #textArea12-3 {
      position: absolute;
      text-align: center;
      line-height: 1.5;
      font-weight: bold;
      color: #fef8f6;
      font-size: 12px;
      bottom: 8%;
      left: 44%;
    }

    #dropArea12-1 {
      position: relative;
      width: 48%;
      height: 28.2%;
      border: 2px solid #ccc;
      top: 16%;
      left: 26%;
    }

    #dropArea12-2 {
      position: absolute;
      width: 19%;
      height: 16.8%;
      border: 2px solid #ccc;
      top: 47%;
      left: 55%;
    }

    #dropArea12-3 {
      position: absolute;
      width: 19%;
      height: 16.8%;
      border: 2px solid #ccc;
      left: 55%;
      top: 66.8%;
    }

    .text-diagonal {
      position: absolute;
      transform: rotate(-8deg);
      width: 34% !important;
      text-align: center;
      font-size: 0.6rem;
      font-weight: bold;
      line-height: 1.2;
      color: #fef8f6;
      top: 14%;
      left: 17%;
    }
  </style>
</head>

<body class="edit-body">
  <div class="content">
    <!-- ーーーー　B面　ーーーー -->
    <div class="uniqueColor" style="background-color:{{ $colors['backgroundColor'] }};">
      <div class="img">
        <img src="/template/p1@2x.png" alt="テンプレート画像" style="width: 100%; max-width: 600px" />
        <div class="input-drop">
          <div id="textArea1-1" class="text-empty text-color textarea" style="color:{{ $colors['textColor'] }};">{{$textData[0]['text'] ?? ''}}</div>
          <div id="textArea1-2" class="text-empty text-color textarea" style="color:{{ $colors['textColor'] }};">{{$textData[1]['text'] ?? ''}}</div>
          <div id="dropArea1" class="empty droparea" style="width: {{ $imageData['width'] }}; height: {{ $imageData['height'] }};">{{$imageData[0][' image '] ?? ''}}</div>
          <div id="textArea1-3" class="text-empty textarea">{{$textData[2]['text'] ?? ''}}</div>
        </div>
      </div>
    </div>
    <div class="uniqueColor" style="background-color:{{ $colors['backgroundColor'] }};">
      <div class="img">
        <img src="/template/p2@2x.png" alt="" style="width: 100%; max-width: 600px" />
        <div class="input-drop">
          <div id="textArea2" class="text-empty text-color textarea" style="color:{{ $colors['textColor'] }};">{{$textData[3]['text'] ?? ''}}</div>
          <div id="dropArea2" class="empty droparea" style="width: {{ $imageData[1]['width'] }}; height: {{ $imageData[1]['height'] }};">{{$imageData[1][' image '] ?? ''}}</div>
        </div>
      </div>
    </div>
    <div class="uniqueColor" style="background-color:{{ $colors['backgroundColor'] }};">
      <div class="img">
        <img src="/template/p3@2x.png" alt="" style="width: 100%; max-width: 600px" />
        <div class="input-drop">
          <div id="textArea3" class="text-empty textarea">{{$textData[4]['text'] ?? ''}}</div>
        </div>
      </div>
    </div>
    <div class="uniqueColor" style="background-color:{{ $colors['backgroundColor'] }};">
      <div class="img">
        <img src="/template/p4@2x.png" alt="" style="width: 100%; max-width: 600px" />
        <div class="input-drop">
          <div id="textArea4-1" class="text-empty textarea">{{$textData[5]['text'] ?? ''}}</div>
          <div id="dropArea4" class="empty droparea" style="width: {{ $imageData[2]['width'] }}; height: {{ $imageData[2]['height'] }};">{{$imageData[2][' image '] ?? ''}}</div>
          <div id="textArea4-2" class="text-empty textarea">{{$textData[6]['text'] ?? ''}}</div>
        </div>
      </div>
    </div>
    <div class="uniqueColor" style="background-color:{{ $colors['backgroundColor'] }};">
      <div class="img">
        <img src="/template/p5@2x.png" alt="" style="width: 100%; max-width: 600px" />
        <div class="input-drop">
          <div id="textArea5" class="text-empty textarea">{{$textData[7]['text'] ?? ''}}</div>
        </div>
      </div>
    </div>
    <div class="uniqueColor" style="background-color:{{ $colors['backgroundColor'] }};">
      <div class="img">
        <img src="/template/p8@2x.png" alt="" style="width: 100%; max-width: 600px" />
        <div class="input-drop">
          <div id="textArea6-1" class="text-empty text-color textarea" style="color:{{ $colors['textColor'] }};">{{$textData[8]['text'] ?? ''}}</div>
          <div id="dropArea6" class="empty droparea" style="width: {{ $imageData[3]['width'] }}; height: {{ $imageData[3]['height'] }};">{{$imageData[3][' image '] ?? ''}}</div>
        </div>
      </div>
    </div>
    <div class="uniqueColor" style="background-color:{{ $colors['backgroundColor'] }};">
      <div class="img">
        <img src="/template/p7@2x.png" alt="" style="width: 100%; max-width: 600px" />
        <div class="input-drop">
          <div id="textArea7" class="text-empty textarea">{{$textData[9]['text'] ?? ''}}</div>
        </div>
      </div>
    </div>
    <div class="uniqueColor" style="background-color:{{ $colors['backgroundColor'] }};">
      <div class="img">
        <img src="/template/p8-AB@2x.png" alt="" style="width: 100%; max-width: 600px" />
        <div class="input-drop">
          <div id="textArea8" class="text-empty textarea">{{$textData[10]['text'] ?? ''}}</div>
          <div id="dropArea8" class="empty droparea" style="width: {{ $imageData[4]['width'] }}; height: {{ $imageData[4]['height'] }};">{{$imageData[4][' image '] ?? ''}}</div>
        </div>
      </div>
    </div>
    <div class="uniqueColor" style="background-color:{{ $colors['backgroundColor'] }};">
      <div class="img">
        <img src="/template/p9@2x.png" alt="" style="width: 100%; max-width: 600px" />
        <div class="input-drop">
          <div id="textArea9" class="text-empty textarea">{{$textData[11]['text'] ?? ''}}</div>
        </div>
      </div>
    </div>
    <div class="uniqueColor" style="background-color:{{ $colors['backgroundColor'] }};">
      <div class="img">
        <img src="/template/p10@2x.png" alt="" style="width: 100%; max-width: 600px" />
        <div class="input-drop">
          <div id="textArea10" class="text-empty text-color textarea" style="color:{{ $colors['textColor'] }};">{{$textData[12]['text'] ?? ''}}</div>
          <div id="dropArea10" class="empty droparea" style="width: {{ $imageData[5]['width'] }}; height: {{ $imageData[5]['height'] }};">{{$imageData[5][' image '] ?? ''}}</div>
        </div>
      </div>
    </div>
    <div class="uniqueColor" style="background-color:{{ $colors['backgroundColor'] }};">
      <div class="img">
        <img src="/template/p11@2x.png" alt="" style="width: 100%; max-width: 600px" />
        <div class="input-drop">
          <div id="textArea11-1" class="text-empty text-color textarea" style="color:{{ $colors['textColor'] }};">{{$textData[13]['text'] ?? ''}}</div>
          <div id="textArea11-2" class="text-empty textarea">{{$textData[14]['text'] ?? ''}}</div>
        </div>
      </div>
    </div>
    <div class="uniqueColor" style="background-color:{{ $colors['backgroundColor'] }};">
      <div class="img">
        <img src="/template/p12@2x.png" alt="" style="width: 100%; max-width: 600px" />
        <div class="input-drop">
          <div id="textArea12-1" class="text-empty text-diagonal textarea">{{$textData[15]['text'] ?? ''}}</div>
          <div id="dropArea12-1" class="empty"></div>
          <div id="textArea12-2" class="text-empty textarea">{{$textData[16]['text'] ?? ''}}</div>
          <div id="dropArea12-2" class="empty"></div>
          <div id="dropArea12-3" class="empty"></div>

          <div id="textArea12-3" class="text-empty textarea">{{$textData[17]['text'] ?? ''}}</div>
        </div>
      </div>
    </div>
    <!-- content -->
  </div>
</body>

</html>