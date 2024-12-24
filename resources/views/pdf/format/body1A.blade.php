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

    .dropareaB {
      border: 2px solid #ccc;
      border-radius: 10%;
      position: absolute;
      top: 60%;
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
    }

    .textareaB {
      position: absolute;
    }


    img {
      border: 1px solid #ddd;
    }

    .uniqueColorB {
      background-color: skyblue;
      /* width: 75.3%; */
    }

    .text-empty {}

    .text-colorB {}

    .empty {}

    /* ーーー　13ページ　ーーー */
    #textArea13-1 {
      font-family: 'League Spartan', sans-serif;
      margin: 30px 0 0 0;
      font-size: 1.2rem;
      line-height: 1.2;
      font-weight: bold;
      text-align: center;
      top: 19%;
    }

    #textArea13-2 {
      font-family: 'League Spartan', sans-serif;
      margin: 0;
      font-size: 0.45rem;
      text-align: center;
      line-height: 1.5;
      font-weight: bold;
      top: 22%;
    }

    #textArea13-3 {
      position: absolute;
      top: 70%;
      font-size: 8pt;
      writing-mode: vertical-rl;
      text-orientation: upright;
      right: 44%;
      text-orientation: upright;
      /* 数字や半角文字を縦向きにする */
      max-height: 10%;
    }

    /* ーーー　14ページ　ーーー */
    #textArea14,
    #textArea18,
    #textArea22 {
      max-height: 35%;
      top: 30%;
      left: 50%;
      font-size: 0.6rem;
      line-height: 1.5;
      text-align: center;
      font-weight: bold;
      writing-mode: vertical-rl;
      text-orientation: upright;
      /* 数字や半角文字を縦向きにする */
    }

    /* ーーー　15ページ　ーーー */
    #textArea15,
    #textArea17,
    #textArea19,
    #textArea21 {
      position: absolute;
      top: 23%;
      right: 35%;
      text-align: justify;
      max-height: 50%;
      writing-mode: vertical-rl;
      font-size: 8pt;
      text-orientation: upright;
      /* 数字や半角文字を縦向きにする */
      letter-spacing: 1pt;
    }

    #dropArea22 {}

    /* ーーー　16ページ　ーーー */
    #textArea16-2 {
      top: 37%;
      min-width: 60%;
      font-size: 0.6rem;
      line-height: 1.5;
      font-weight: bold;
      text-align: center;
      color: #fef8f6;
      text-orientation: upright;
    }

    #textArea16-1,
    #textArea20 {
      top: 27%;
      min-width: 60%;
      font-size: 0.6rem;
      line-height: 1.5;
      font-weight: bold;
      text-align: center;
      color: #fef8f6;
      text-orientation: upright;
      /* 数字や半角文字を縦向きにする */
      margin-bottom: -1%;
    }

    /* ーーー　17ページ　ーーー */
    #dropArea20 {}

    #dropArea18 {}

    #dropArea16 {}

    #dropArea14 {}

    #dropArea13 {}

    /* ーーー　18ページ　ーーー */
    /* ーーー　19ページ　ーーー */
    /* ーーー　20ページ　ーーー */
    /* ーーー　21ページ　ーーー */
    /* ーーー　22ページ　ーーー */
    /* ーーー　23ページ　ーーー */
    #textArea23-1 {
      font-family: 'League Spartan', sans-serif;
      min-width: 60%;
      margin-bottom: 5%;
      margin-top: 5%;
      font-size: 0.7rem;
      line-height: 1.5;
      font-weight: bold;
      text-align: center;
      top: 17%;
      text-orientation: upright;
      /* 数字や半角文字を縦向きにする */
    }

    #textArea23-2 {
      min-height: 50%;
      max-height: 30%;
      margin-bottom: 2.5%;
      margin-top: 2.5%;
      font-size: 0.33rem;
      top: 17%;
      text-orientation: upright;
      /* 数字や半角文字を縦向きにする */
    }

    /* ーーー　24ページ　ーーー */
    #textArea24-1 {
      position: absolute;
      top: 11%;
      font-family: 'League Spartan', sans-serif;
      text-align: center;
      font-weight: bold;
      min-width: 60%;
      font-size: 0.7rem;
      line-height: 1;
      text-orientation: upright;
      left: 20%;
    }

    #textArea24-2 {
      height: 65% !important;
      width: 50% !important;
      writing-mode: vertical-rl;
      font-size: 0.26rem;
      bottom: 27%;
      left: 15%;
      text-orientation: upright;
      /* 数字や半角文字を縦向きにする */
    }

    #textArea24-4 {
      position: absolute;
      text-align: center;
      line-height: 1.5;
      font-weight: bold;
      color: #fef8f6;
      font-size: 12px;
      bottom: 8%;
      left: 44%;
      text-orientation: upright;
      /* 数字や半角文字を縦向きにする */
    }

    #dropArea24-1 {
      width: 48%;
      height: 28.2%;
      border: 2px solid #ccc;
      top: 55.5%;
      left: 26%;
    }

    #dropArea24-2 {
      position: absolute;
      width: 19%;
      height: 16.8%;
      border: 2px solid #ccc;
      right: 54.5%;
      top: 16%;
    }

    #dropArea24-3 {
      position: absolute;
      width: 19%;
      height: 16.8%;
      border: 2px solid #ccc;
      right: 54.5%;
      top: 35.8%;
    }
  </style>
</head>

<body style="background-color:rgb(0, 145, 65);">
  <img src="{{ asset('img/kotobum_format1/2-12@2x.png') }}" alt="" style=" width: 100%;"/>
  <div id="textArea24-1" class="empty text-colorB textarea" style="position:absolute;  width: 48%; height: 28.2%;  border: 2px solid #ccc;  top: 55.5%;  left: 26%; color:{{ $colors['textColor'] ?? '#000000'}};">{{$textData[0]['text'] ?? ''}}</div>
  <div id="dropArea24-1" class="empty" style="position:absolute;"></div>
  <div id="dropArea24-2" class="empty" style="position:absolute;"></div>
  <div id="textArea24-2" class="empty textarea" style="position:absolute;">{{$textData[1]['text'] ?? ''}}</div>
  <div id="dropArea24-3" class="empty" style="position:absolute;"></div>
  <div id="textArea24-4" class="empty textareaB" style="position:absolute;">{{$textData[2]['text'] ?? ''}}</div>

    
  <pagebreak />

  <img src="{{ asset('img/kotobum_format1/2-11@2x.png') }}" alt="" style="width: 100%;" />
  <div id="textArea23-1" class="empty text-colorB textarea" style="position:absolute; color:{{ $colors['textColor'] ?? '#000000'}};">{{$textData[3]['text'] ?? ''}}</div>
  <div id="textArea23-2" class="empty textarea" style="position:absolute;">{{$textData[4]['text'] ?? ''}}</div>


  <pagebreak />

  <img src="{{ asset('img/kotobum_format1/2-10@2x.png') }}" alt="" style="width: 100%;" />
  <div id="textArea22" class="empty text-colorB textarea" style="position:absolute; color:{{ $colors['textColor'] ?? '#000000'}};">{{$textData[5]['text'] ?? ''}}</div>
  <div id="dropArea22" class="empty dropareaB" style="position:absolute; width: {{ $imageData[0]['width'] ?? '50'}}; height: {{ $imageData[0]['height'] ?? '50'}};">{{$imageData[0][' image '] ?? ''}}</div>

  <pagebreak />

  <img src="{{ asset('img/kotobum_format1/2-9@2x.png') }}" alt="" style="width: 100%;" />
  <div id="textArea21" class="empty textareaB" style="position:absolute;">{{$textData[6]['text'] ?? ''}}</div>


  <pagebreak />

  <img src="{{ asset('img/kotobum_format1/2-8@2x.png') }}" alt="" style="width: 100%;" />
  <div id="textArea20" class="empty textarea" style="position:absolute;">{{$textData[7]['text'] ?? ''}}</div>
  <div id="dropArea20" class="empty dropareaB" style="position:absolute; width: {{ $imageData[1]['width'] ?? '50'}}; height: {{ $imageData[1]['height'] ?? '50'}};">{{$imageData[1][' image '] ?? ''}}</div>

  <pagebreak />

  <img src="{{ asset('img/kotobum_format1/2-7@2x.png') }}" alt="" style="width: 100%;" />
  <div id="textArea19" class="empty textareaB" style="position:absolute;">{{$textData[8]['text'] ?? ''}}</div>

  <pagebreak />

  <img src="{{ asset('img/kotobum_format1/2-6@2x.png') }}" alt="" style="width: 100%;" />
  <div id="textArea18" class="empty textarea" style="position:absolute;">{{$textData[9]['text'] ?? ''}}</div>
  <div id="dropArea18" class="empty dropareaB" style="position:absolute; width: {{ $imageData[2]['width'] ?? '50'}}; height: {{ $imageData[2]['height'] ?? '50'}};">{{$imageData[2][' image '] ?? ''}}</div>

  <pagebreak />

  <img src="{{ asset('img/kotobum_format1/2-5@2x.png') }}" alt="" style="width: 100%;" />
  <div id="textArea17" class="empty textareaB" style="position:absolute;">{{$textData[10]['text'] ?? ''}}</div>

  <pagebreak />

  <img src="{{ asset('img/kotobum_format1/1-4@2x.png') }}" alt="" style="width: 100%;" />
  <div id="textArea16-1" class="empty textarea" style="position:absolute;">{{$textData[11]['text'] ?? ''}}</div>
  <div id="dropArea16" class="empty dropareaB" style="position:absolute; width: {{ $imageData[3]['width'] ?? '50'}}; height: {{ $imageData[3]['height'] ?? '50'}};">{{$imageData[3][' image '] ?? ''}}</div>
  <div id="textArea16-2" class="empty textarea" style="position:absolute;">{{$textData[12]['text'] ?? ''}}</div>

  <pagebreak />


  <img src="{{ asset('img/kotobum_format1/1-3@2x.png') }}" alt="" style="width: 100%;" />
  <div id="textArea15" class="empty textareaB" style="position:absolute;">{{$textData[13]['text'] ?? ''}}</div>

  <pagebreak />

  <img src="{{ asset('img/kotobum_format1/1-2@2x.png') }}" alt="" style="width: 100%;" />
  <div id="textArea14" class="text-empty text-colorB textarea" style="position:absolute; color:{{ $colors['textColor'] ?? '#000000'}};">{{$textData[14]['text'] ?? ''}}</div>
  <div id="dropArea14" class="empty dropareaB" style="position:absolute; width: {{ $imageData[4]['width'] ?? '50'}}; height: {{ $imageData[4]['height'] ?? '50'}};">{{$imageData[4][' image '] ?? ''}}</div>

  <pagebreak />

  <img src="{{ asset('img/kotobum_format1/1-1@2x.png') }}" alt="" style="width: 100%;" />
  <div id="textArea13-1" class="empty text-colorB textarea" style="position:absolute; color:{{ $colors['textColor'] ?? '#000000'}};">{{$textData[17]['text'] ?? ''}}</div>
  <div id="textArea13-2" class="empty text-colorB textarea" style="position:absolute; color:{{ $colors['textColor'] ?? '#000000'}};">{{$textData[16]['text'] ?? ''}}</div>
  <div id="dropArea13" class="empty droparea" style="position:absolute; width: {{ $imageData[5]['width'] ?? '50'}}; height: {{ $imageData[5]['height'] ?? '50'}};"><{{$imageData[5][' image '] ?? ''}}/div>
  <div id="textArea13-3" class="empty textareaB" style="position:absolute;">{{$textData[15]['text'] ?? ''}}</div>

</body>

</html>