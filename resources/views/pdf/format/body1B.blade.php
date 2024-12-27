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

    .droparea {
      border-radius: 10%;
    }

    .dropareaB {
      border-radius: 10%;
    }

    .empty {
      border: 1px solid #ddd;
    }

    #dropArea12-1 {
     border:2px solid #ccc;
    }

    #dropArea12-2 {
     border: 2px solid #ccc;
    }

    #dropArea12-3 {
      border: 2px solid #ccc;
    }

    .text-diagonal {
      transform: rotate(-8deg); width:34%; text-align:center; font-size:0.6rem; font-weight:bold; line-height:1.2; color:#fef8f6;
    }
  </style>
</head>

<body style="background-color:{{ $colors['backgroundColor'] ?? '#000000' }}; ">

  <img src="{{ asset('img/kotobum_format1/1-1@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
  <div id="textArea1-1" class="text-empty text-color textarea" style="position:absolute; width:{{ $textData[0]['width'] ?? '50'}}; height:{{ $textData[0]['height'] ?? '50'}}; top:{{ $textData[0]['top'] ?? '50'}};  left:{{ $textData[0]['left'] ?? '50'}}; font-family: 'League Spartan', sans-serif; margin:30px 0 0 0; font-size:1.2rem; line-height:1.2; font-weight:bold; text-align:center; color:{{ $colors['textColor'] }};">{{$textData[0]['text'] ?? ''}}</div>
  <div id="textArea1-2" class="text-empty text-color textarea" style="position:absolute; width:{{ $textData[0]['width'] ?? '50'}}; height:{{ $textData[0]['height'] ?? '50'}}; top:{{ $textData[0]['top'] ?? '50'}};  left:{{ $textData[0]['left'] ?? '50'}}; font-family: 'League Spartan', sans-serif; margin:0; font-size:0.45rem; text-align:center; line-height:1.5; font-weight:bold; color:{{ $colors['textColor'] }};">{{$textData[1]['text'] ?? ''}}</div>
  <div id="dropArea1" class="empty droparea" style="position:absolute; width: {{ $imageData['width'] }}; height: {{ $imageData['height'] }};">
  <div id="textArea1-3" class="text-empty textarea" style="position:absolute; width:{{ $textData[0]['width'] ?? '50'}}; height:{{ $textData[0]['height'] ?? '50'}}; top:{{ $textData[0]['top'] ?? '50'}};  left:{{ $textData[0]['left'] ?? '50'}}; text-align:center;">{{$textData[2]['text'] ?? ''}}</div>

  <pagebreak />

  <img src="{{ asset('img/kotobum_format1/1-2@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
  <div id="textArea2" class="text-empty text-color textarea" style="position:absolute; width:{{ $textData[0]['width'] ?? '50'}}; height:{{ $textData[0]['height'] ?? '50'}}; top:{{ $textData[0]['top'] ?? '50'}};  left:{{ $textData[0]['left'] ?? '50'}}; font-size:0.6rem; line-height:1.5; font-weight:bold; text-align:center; color:{{ $colors['textColor'] }};">{{$textData[3]['text'] ?? ''}}</div>
  <div id="dropArea2" class="empty droparea" style="position:absolute; width: {{ $imageData[1]['width'] }}; height: {{ $imageData[1]['height'] }};">

  <pagebreak />

  <img src="{{ asset('img/kotobum_format1/1-3@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
  <div id="textArea3" class="text-empty textarea" style="position:absolute; width:{{ $textData[0]['width'] ?? '50'}}; height:{{ $textData[0]['height'] ?? '50'}}; top:{{ $textData[0]['top'] ?? '50'}};  left:{{ $textData[0]['left'] ?? '50'}}; font-size:8pt; max-width:38%; text-align:left; ">{{$textData[4]['text'] ?? ''}}</div>


  <pagebreak />

  <img src="{{ asset('img/kotobum_format1/1-4@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
  <div id="textArea4-1" class="text-empty textarea" style="position:absolute; width:{{ $textData[0]['width'] ?? '50'}}; height:{{ $textData[0]['height'] ?? '50'}}; top:{{ $textData[0]['top'] ?? '50'}};  left:{{ $textData[0]['left'] ?? '50'}}; font-size: 0.6rem; line-height: 1.5; font-weight: bold; color: #fef8f6; text-align: center; top: 28%;">{{$textData[5]['text'] ?? ''}}</div>
  <div id="dropArea4" class="empty droparea" style="position:absolute; width: {{ $imageData[2]['width'] }}; height: {{ $imageData[2]['height'] }};">
  <div id="textArea4-2" class="text-empty textarea" style="position:absolute; width:{{ $textData[0]['width'] ?? '50'}}; height:{{ $textData[0]['height'] ?? '50'}}; top:{{ $textData[0]['top'] ?? '50'}};  left:{{ $textData[0]['left'] ?? '50'}}; font-size:0.6rem; line-height:1.5; font-weight:bold; color:#fef8f6; text-align:center;">{{$textData[6]['text'] ?? ''}}</div>

  <pagebreak />

  <img src="{{ asset('img/kotobum_format1/1-5@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
  <div id="textArea5" class="text-empty textarea" style="position:absolute; width:{{ $textData[0]['width'] ?? '50'}}; height:{{ $textData[0]['height'] ?? '50'}}; top:{{ $textData[0]['top'] ?? '50'}};  left:{{ $textData[0]['left'] ?? '50'}}; font-size:8pt; max-width:38%; text-align:left;">{{$textData[7]['text'] ?? ''}}</div>


  <pagebreak />

  <img src="{{ asset('img/kotobum_format1/1-6@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
  <div id="textArea6-1" class="text-empty text-color textarea" style="position:absolute; width:{{ $textData[0]['width'] ?? '50'}}; height:{{ $textData[0]['height'] ?? '50'}}; top:{{ $textData[0]['top'] ?? '50'}};  left:{{ $textData[0]['left'] ?? '50'}};  font-size:0.6rem; line-height:1.5; font-weight:bold; text-align:center; color:{{ $colors['textColor'] }};">{{$textData[8]['text'] ?? ''}}</div>
  <div id="dropArea6" class="empty droparea" style="position:absolute; width: {{ $imageData[3]['width'] }}; height: {{ $imageData[3]['height'] }};">

  <pagebreak />

  <img src="{{ asset('img/kotobum_format1/1-7@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
  <div id="textArea7" class="text-empty textarea" style="position:absolute; width:{{ $textData[0]['width'] ?? '50'}}; height:{{ $textData[0]['height'] ?? '50'}}; top:{{ $textData[0]['top'] ?? '50'}};  left:{{ $textData[0]['left'] ?? '50'}}; font-size:8pt; max-width:38%; text-align:left;">{{$textData[9]['text'] ?? ''}}</div>


  <pagebreak />

  <img src="{{ asset('img/kotobum_format1/1-8@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
  <div id="textArea8" class="text-empty textarea" style="position:absolute; width:{{ $textData[0]['width'] ?? '50'}}; height:{{ $textData[0]['height'] ?? '50'}}; top:{{ $textData[0]['top'] ?? '50'}};  left:{{ $textData[0]['left'] ?? '50'}}; font-size:0.6rem; line-height:1.5; font-weight:bold; text-align:center; color:#fef8f6;">{{$textData[10]['text'] ?? ''}}</div>
  <div id="dropArea8" class="empty droparea" style="position:absolute; width: {{ $imageData[4]['width'] }}; height: {{ $imageData[4]['height'] }};">


  <pagebreak />

  <img src="{{ asset('img/kotobum_format1/1-9@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
  <div id="textArea9" class="text-empty textarea" style="position:absolute; width:{{ $textData[0]['width'] ?? '50'}}; height:{{ $textData[0]['height'] ?? '50'}}; top:{{ $textData[0]['top'] ?? '50'}};  left:{{ $textData[0]['left'] ?? '50'}}; font-size:8pt; max-width:38%; text-align:left;">{{$textData[11]['text'] ?? ''}}</div>


  <pagebreak />

  <img src="{{ asset('img/kotobum_format1/1-10@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
  <div id="textArea10" class="text-empty text-color textarea" style="position:absolute; width:{{ $textData[0]['width'] ?? '50'}}; height:{{ $textData[0]['height'] ?? '50'}}; top:{{ $textData[0]['top'] ?? '50'}};  left:{{ $textData[0]['left'] ?? '50'}};  font-size:0.6rem; line-height:1.5; font-weight:bold; text-align:center; color:{{ $colors['textColor'] }};">{{$textData[12]['text'] ?? ''}}</div>
  <div id="dropArea10" class="empty droparea" style="position:absolute; width: {{ $imageData[5]['width'] }}; height: {{ $imageData[5]['height'] }};">


  <pagebreak />


  <img src="{{ asset('img/kotobum_format1/1-11@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />

  <div id="textArea11-1" class="text-empty text-color textarea" style="position:absolute; width:{{ $textData[0]['width'] ?? '50'}}; height:{{ $textData[0]['height'] ?? '50'}}; top:{{ $textData[0]['top'] ?? '50'}};  left:{{ $textData[0]['left'] ?? '50'}}; font-family:'League Spartan', sans-serif; min-width:60%; margin-bottom:5%; margin-top:5%; font-size:0.7rem; line-height:1.5; font-weight:bold; text-align:center; color:{{ $colors['textColor'] }};">{{$textData[13]['text'] ?? ''}}</div>
  <div id="textArea11-2" class="text-empty textarea" style="position:absolute; width:{{ $textData[0]['width'] ?? '50'}}; height:{{ $textData[0]['height'] ?? '50'}}; top:{{ $textData[0]['top'] ?? '50'}};  left:{{ $textData[0]['left'] ?? '50'}}; min-height:50%; max-height:30%; margin-bottom:2.5%; margin-top:2.5%; font-size:0.33rem;">{{$textData[14]['text'] ?? ''}}</div>


  <pagebreak />


  <img src="{{ asset('img/kotobum_format1/1-12@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />

  <div id="textArea12-1" class="text-empty text-diagonal textarea">{{$textData[15]['text'] ?? ''}}</div>
  <div id="dropArea12-1" class="empty droparea" style="position:absolute; width: {{ $imageData[6]['width'] }}; height: {{ $imageData[6]['height'] }};">
  <div id="textArea12-2" class="text-empty textarea" style="position:absolute; width:{{ $textData[0]['width'] ?? '50'}}; height:{{ $textData[0]['height'] ?? '50'}}; top:{{ $textData[0]['top'] ?? '50'}};  left:{{ $textData[0]['left'] ?? '50'}}; font-size:0.25rem;">{{$textData[16]['text'] ?? ''}}</div>
  <div id="dropArea12-2" class="empty droparea" style="position:absolute; width: {{ $imageData[7]['width'] }}; height: {{ $imageData[7]['height'] }};">
  <div id="dropArea12-3" class="empty droparea" style="position:absolute; width: {{ $imageData[8]['width'] }}; height: {{ $imageData[8]['height'] }};">

  <div id="textArea12-3" class="text-empty textarea" style="width:{{ $textData[0]['width'] ?? '50'}}; height:{{ $textData[0]['height'] ?? '50'}}; top:{{ $textData[0]['top'] ?? '50'}};  left:{{ $textData[0]['left'] ?? '50'}}; text-align:center; line-height:1.5; font-weight:bold; color:#fef8f6; font-size:12px;">{{$textData[17]['text'] ?? ''}}</div>

</body>

</html>