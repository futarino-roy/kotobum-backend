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

  </style>
</head>

<body style="background-color:{{ $colors['backgroundColor'] ?? '#000000' }}; text-align:center;">
  <img src="{{ asset('img/kotobum_format1/2-12@2x.png') }}" alt="" style="width: 158mm; height:218mm;"/>
  <div id="textArea24-1" class="empty text-colorB textarea" style="position:absolute; width:{{ $textData[0]['width'] ?? '50'}}pt; height:{{ $textData[0]['height'] ?? '50'}}pt; top:{{ $textData[0]['top'] ?? '50'}}pt;  left:{{ $textData[0]['left'] ?? '50'}}pt; text-orientation:upright; font-size:13pt; line-height:1; font-family:'League Spartan',sans-serif; text-align:center; font-weight: bold; color:{{ $colors['textColor'] ?? '#000000'}};">{{$textData[0]['text'] ?? ''}}</div>
  <div id="frontimg24-1" style="position:absolute; width:{{ $imageData[0]['width'] ?? '50'}}pt; height:{{ $imageData[0]['height'] ?? '50'}}pt; top:{{ $imageData[0]['top'] ?? '50'}}pt;  left:{{ $imageData[0]['left'] ?? '50'}}pt;"><img src="{{ $imageData[0]['image'] }}" id="dropArea24-1" class="empty" ></div>
  <div id="frontimg24-2" style="position:absolute; width:{{ $imageData[1]['width'] ?? '50'}}pt; height:{{ $imageData[1]['height'] ?? '50'}}pt; top:{{ $imageData[1]['top'] ?? '50'}}pt;  left:{{ $imageData[1]['left'] ?? '50'}}pt;"><img src="{{ $imageData[1]['image'] }}" id="dropArea24-2" class="empty" ></div>
  <div id="textArea24-2" class="empty textarea" style="position:absolute; width:{{ $textData[1]['width'] ?? '50'}}pt; height:{{ $textData[1]['height'] ?? '50'}}pt; top:{{ $textData[1]['top'] ?? '50'}}pt;  left:{{ $textData[1]['left'] ?? '50'}}pt; writing-mode:vertical-rl; font-size:7.5pt; text-orientation:upright;">{{$textData[1]['text'] ?? ''}}</div>
  <div id="frontimg24-3" style="position:absolute; width:{{ $imageData[2]['width'] ?? '50'}}pt; height:{{ $imageData[2]['height'] ?? '50'}}pt; top:{{ $imageData[2]['top'] ?? '50'}}pt;  left:{{ $imageData[2]['left'] ?? '50'}}pt;"><img src="{{ $imageData[2]['image'] }}" id="dropArea24-3" class="empty" ></div>
  <div id="textArea24-4" class="empty textareaB" style="position:absolute; width:{{ $textData[2]['width'] ?? '50'}}pt; height:{{ $textData[2]['height'] ?? '50'}}pt; top:{{ $textData[2]['top'] ?? '50'}}pt;  left:{{ $textData[2]['left'] ?? '50'}}pt; text-orientation:upright; text-align:center; line-height:1.5; font-weight:bold; color:#fef8f6; font-size:12.3pt; ">{{$textData[2]['text'] ?? ''}}</div>

    
  <pagebreak />

  <img src="{{ asset('img/kotobum_format1/2-11@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
  <div id="textArea23-1" class="empty text-colorB textarea" style="position:absolute; width:{{ $textData[3]['width'] ?? '50'}}pt; height:{{ $textData[3]['height'] ?? '50'}}pt; top:{{ $textData[3]['top'] ?? '50'}}pt;  left:{{ $textData[3]['left'] ?? '50'}}pt; color:{{ $colors['textColor'] ?? '#000000'}}; font-family:'League Spartan',sans-serif; font-size:0.7rem; line-height:1.5; font-weight:bold; text-align:center; text-orientation:upright;">{{$textData[3]['text'] ?? ''}}</div>
  <div id="textArea23-2" class="empty textarea" style="position:absolute; width:{{ $textData[4]['width'] ?? '50'}}pt; height:{{ $textData[4]['height'] ?? '50'}}pt; top:{{ $textData[4]['top'] ?? '50'}}pt;  left:{{ $textData[4]['left'] ?? '50'}}pt; text-orientation:upright; font-size: 7.5pt;">{{$textData[4]['text'] ?? ''}}</div>


  <pagebreak />

  <img src="{{ asset('img/kotobum_format1/2-10@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
  <div id="textArea22" class="empty text-colorB textarea" style="position:absolute; width:{{ $textData[5]['width'] ?? '50'}}pt; height:{{ $textData[5]['height'] ?? '50'}}pt; top:{{ $textData[5]['top'] ?? '50'}}pt;  left:{{ $textData[5]['left'] ?? '50'}}pt; color:{{ $colors['textColor'] ?? '#000000'}}; font-size:14pt; line-height: 1.5; text-align:center; font-weight:bold; writing-mode:vertical-rl; text-orientation:upright;">{{$textData[5]['text'] ?? ''}}</div>
  <div id="frontimg22" style="position:absolute; width:{{ $imageData[3]['width'] ?? '50'}}pt; height:{{ $imageData[3]['height'] ?? '50'}}pt; top:{{ $imageData[3]['top'] ?? '50'}}pt;  left:{{ $imageData[3]['left'] ?? '50'}}pt;"><img src="{{ $imageData[3]['image'] }}" id="dropArea22" class="empty dropareaB" ></div>

  <pagebreak />

  <img src="{{ asset('img/kotobum_format1/2-9@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
  <div id="textArea21" class="empty textareaB" style="position:absolute; width:{{ $textData[6]['width'] ?? '50'}}pt; height:{{ $textData[6]['height'] ?? '50'}}pt; top:{{ $textData[6]['top'] ?? '50'}}pt;  left:{{ $textData[6]['left'] ?? '50'}}pt; text-align:justify; writing-mode:vertical-rl; font-size:7.5pt; text-orientation:upright; letter-spacing:1pt;">{{$textData[6]['text'] ?? ''}}</div>


  <pagebreak />

  <img src="{{ asset('img/kotobum_format1/2-8@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
  <div id="textArea20" class="empty textarea" style="position:absolute; width:{{ $textData[7]['width'] ?? '50'}}pt; height:{{ $textData[7]['height'] ?? '50'}}pt; top:{{ $textData[7]['top'] ?? '50'}}pt;  left:{{ $textData[7]['left'] ?? '50'}}pt; font-size:14pt; line-height:1.5; font-weight:bold; text-align:center; color:#fef8f6; text-orientation:upright;">{{$textData[7]['text'] ?? ''}}</div>
  <div id="frontimg20" style="position:absolute; width:{{ $imageData[4]['width'] ?? '50'}}pt; height:{{ $imageData[4]['height'] ?? '50'}}pt; top:{{ $imageData[4]['top'] ?? '50'}}pt;  left:{{ $imageData[4]['left'] ?? '50'}}pt;"><img src="{{ $imageData[4]['image'] }}" id="dropArea20" class="empty dropareaB" ></div>

  <pagebreak />

  <img src="{{ asset('img/kotobum_format1/2-7@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
  <div id="textArea19" class="empty textareaB" style="position:absolute; width:{{ $textData[8]['width'] ?? '50'}}pt; height:{{ $textData[8]['height'] ?? '50'}}pt; top:{{ $textData[8]['top'] ?? '50'}}pt;  left:{{ $textData[8]['left'] ?? '50'}}pt; text-align:justify; writing-mode:vertical-rl; font-size:7.5pt; text-orientation:upright; letter-spacing:1pt;">{{$textData[8]['text'] ?? ''}}</div>

  <pagebreak />

  <img src="{{ asset('img/kotobum_format1/2-6@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
  <div id="textArea18" class="empty textarea" style="position:absolute; width:{{ $textData[9]['width'] ?? '50'}}pt; height:{{ $textData[9]['height'] ?? '50'}}pt; top:{{ $textData[9]['top'] ?? '50'}}pt;  left:{{ $textData[9]['left'] ?? '50'}}pt; font-size:14pt; line-height: 1.5; text-align:center; font-weight:bold; writing-mode:vertical-rl; text-orientation:upright;">{{$textData[9]['text'] ?? ''}}</div>
  <div id="frontimg18" style="position:absolute; width:{{ $imageData[5]['width'] ?? '50'}}pt; height:{{ $imageData[5]['height'] ?? '50'}}pt; top:{{ $imageData[5]['top'] ?? '50'}}pt;  left:{{ $imageData[5]['left'] ?? '50'}}pt;"><img src="{{ $imageData[5]['image'] }}" id="dropArea18" class="empty dropareaB" ></div>

  <pagebreak />

  <img src="{{ asset('img/kotobum_format1/2-5@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
  <div id="textArea17" class="empty textareaB" style="position:absolute; width:{{ $textData[10]['width'] ?? '50'}}pt; height:{{ $textData[10]['height'] ?? '50'}}pt; top:{{ $textData[10]['top'] ?? '50'}}pt;  left:{{ $textData[10]['left'] ?? '50'}}pt; text-align:justify; writing-mode:vertical-rl; font-size:7.5pt; text-orientation:upright; letter-spacing:1pt;">{{$textData[10]['text'] ?? ''}}</div>

  <pagebreak />

  <img src="{{ asset('img/kotobum_format1/1-4@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
  <div id="textArea16-1" class="empty textarea" style="position:absolute; width:{{ $textData[11]['width'] ?? '50'}}pt; height:{{ $textData[11]['height'] ?? '50'}}pt; top:{{ $textData[11]['top'] ?? '50'}}pt;  left:{{ $textData[11]['left'] ?? '50'}}pt; font-size:16pt; line-height:1.5; font-weight:bold; text-align:center; color:#fef8f6; text-orientation:upright;">{{$textData[11]['text'] ?? ''}}</div>
  <div id="frontung16" style="position:absolute; width:{{ $imageData[6]['width'] ?? '50'}}pt; height:{{ $imageData[6]['height'] ?? '50'}}pt; top:{{ $imageData[6]['top'] ?? '50'}}pt;  left:{{ $imageData[6]['left'] ?? '50'}}pt;"><img src="{{ $imageData[6]['image'] }}" id="dropArea16" class="empty dropareaB" ></div>
  <div id="textArea16-2" class="empty textarea" style="position:absolute; width:{{ $textData[12]['width'] ?? '50'}}pt; height:{{ $textData[12]['height'] ?? '50'}}pt; top:{{ $textData[12]['top'] ?? '50'}}pt;  left:{{ $textData[12]['left'] ?? '50'}}pt; font-size:14pt; line-height:1.5; font-weight:bold; text-align:center; color:#fef8f6; text-orientation:upright;">{{$textData[12]['text'] ?? ''}}</div>

  <pagebreak />


  <img src="{{ asset('img/kotobum_format1/1-3@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
  <div id="textArea15" class="empty textareaB" style="position:absolute; width:{{ $textData[13]['width'] ?? '50'}}pt; height:{{ $textData[13]['height'] ?? '50'}}pt; top:{{ $textData[13]['top'] ?? '50'}}pt;  left:{{ $textData[13]['left'] ?? '50'}}pt; text-align:justify; writing-mode:vertical-rl; font-size:7.5pt; text-orientation:upright; letter-spacing:1pt;">{{$textData[13]['text'] ?? ''}}</div>

  <pagebreak />

  <img src="{{ asset('img/kotobum_format1/1-2@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
  <div id="textArea14" class="empty text-colorB textarea" style="position:absolute; width:{{ $textData[14]['width'] ?? '50'}}pt; height:{{ $textData[14]['height'] ?? '50'}}pt; top:{{ $textData[14]['top'] ?? '50'}}pt;  left:{{ $textData[14]['left'] ?? '50'}}pt; color:{{ $colors['textColor'] ?? '#000000'}}; font-size:16pt; line-height: 1.5; text-align:center; font-weight:bold; writing-mode:vertical-rl; text-orientation:upright;">{{$textData[14]['text'] ?? ''}}</div>
  <div id="frontimg14" style="position:absolute; width:{{ $imageData[7]['width'] ?? '50'}}pt; height:{{ $imageData[7]['height'] ?? '50'}}pt; top:{{ $imageData[7]['top'] ?? '50'}}pt;  left:{{ $imageData[7]['left'] ?? '50'}}pt;"><img src="{{ $imageData[7]['image'] }}" id="dropArea14" class="empty dropareaB" ></div>

  <pagebreak />

  <img src="{{ asset('img/kotobum_format1/1-1@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
  <div id="textArea13-1" class="empty text-colorB textarea" style="position:absolute; width:{{ $textData[15]['width'] ?? '50'}}pt; height:{{ $textData[15]['height'] ?? '50'}}pt; top:{{ $textData[15]['top'] ?? '50'}}pt;  left:{{ $textData[15]['left'] ?? '50'}}pt; color:{{ $colors['textColor'] ?? '#000000'}}; font-family:'League Spartan', sans-serif; margin:30px 0 0 0; font-size:28.6pt; line-height:1.2; font-weight:bold; text-align:center;">{{$textData[15]['text'] ?? ''}}</div>
  <div id="textArea13-2" class="empty text-colorB textarea" style="position:absolute; width:{{ $textData[16]['width'] ?? '50'}}pt; height:{{ $textData[16]['height'] ?? '50'}}pt; top:{{ $textData[16]['top'] ?? '50'}}pt;  left:{{ $textData[16]['left'] ?? '50'}}pt; font-family:'League Spartan', sans-serif; font-size:12pt; text-align:center; line-height:1.5; font-weight:bold;">{{$textData[16]['text'] ?? ''}}</div>
  <div id="frontimg13" style="position:absolute; width:{{ $imageData[8]['width'] ?? '50'}}pt; height:{{ $imageData[8]['height'] ?? '50'}}pt; top:{{ $imageData[8]['top'] ?? '50'}}pt;  left:{{ $imageData[8]['left'] ?? '50'}}pt;"><img src="{{ $imageData[8]['image'] }}" id="dropArea13" class="empty droparea" ></div>
  <div id="textArea13-3" class="empty textareaB" style="position:absolute;width:{{ $textData[17]['width'] ?? '50'}}pt; height:{{ $textData[17]['height'] ?? '50'}}pt; top:{{ $textData[17]['top'] ?? '50'}}pt;  left:{{ $textData[17]['left'] ?? '50'}}pt; font-size:7.5pt; writing-mode:vertical-rl; text-orientation:upright;">{{$textData[17]['text'] ?? ''}}</div>

</body>

</html>