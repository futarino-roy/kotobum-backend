<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <title>PDFテンプレートcover</title>
    <style>
      /* ローカルフォントを使う例 */
      @font-face {
        font-family: 'Zen Maru Gothic';
        src: url('public/fonts/ZenMaruGothic-Regular.ttf') format('truetype');
      }
      @font-face {
        font-family: 'League Spartan';
        src: url('public/fonts/LeagueSpartan-Regular.ttf') format('truetype');
      }
      body {
        font-family: 'Zen Maru Gothic', sans-serif;
        margin: 0;
        padding: 0;
      }
      .content {
        text-align: center;
        margin: 20px auto;
        width: 335mm;
        position: relative;
      }
      img {
        position: relative;
      }
      .uniqueColor {
        width: 138mm;
        height: 196mm;
        position: absolute;
        top: 103px;
        left: 51%;
      }
      .uniqueColorB {
        width: 138mm;
        height: 196mm;
        position: absolute;
        top: 103px;
        right: 51%;
      }
      .droparea {
        position: absolute;
        width: 90%;
        height: 60%;
        bottom: 3%;
        left: 5%;
        border: 1px solid #ccc;
      }
      #textAreaB-1 {
        position: absolute;
        top: 14%;
        left: 9%;
        font-size: 17pt;
      }
      #textAreaB-2 {
        position: absolute;
        top: 20%;
        left: 7%;
        font-size: 11.5pt;
      }
      #textAreaB-3 {
        position: absolute;
        right: 3%;
        text-align: right;
        top: 6%;
        font-size: 30pt;
        font-weight: bold;
      }
      #textAreaA-1 {
        position: absolute;
        top: 14%;
        right: 9%;
      }
      #textAreaA-2 {
        position: absolute;
        top: 20%;
        right: 7%;
      }
      #textAreaA-3 {
        position: absolute;
        left: 3%;
        text-align: right;
        top: 6%;
        font-size: 30pt;
        font-weight: bold;
      }
      #textArea_cover {
        transform: rotate(270deg);
        margin: 0;
        position: absolute;
        height: auto;
        bottom: 18%;
        left: 46%;
        font-weight: bold;
        font-size: 10pt;
        text-align: start;
      }

    </style>
  </head>
  <body>
    <div class="content">
      <img src="/images/cover_PDF@2x.png" alt="" style="width: 100%; max-width: 335mm; border: 1px solid #ccc; border-right: none" />
      <div class="uniqueColorB">
        <div class="img imgB">
          <div class="input-drop">
            <div id="textAreaB-1" class="text-empty text-size">サーバーから取得</div>
            <div id="textAreaB-2" class="text-empty text-colorB">サーバーから取得</div>
            <div id="textAreaB-3" class="text-empty text-colorB">サーバーから取得</div>
            <div id="dropAreaB" class="empty droparea"></div>
          </div>
        </div>
      </div>

      <div class="uniqueColor">
        <div class="img imgA">
          <div class="input-drop">
            <div id="textAreaA-1" class="text-empty text-size">サーバーから取得</div>
            <div id="textAreaA-2" class="text-empty text-color">サーバーから取得</div>
            <div id="textAreaA-3" class="text-empty text-color">サーバーから取得</div>
            <div id="dropAreaA" class="empty droparea"></div>
          </div>
        </div>
      </div>

      <div id="textArea_cover">サーバーから取得</div>
    </div>
  </body>
<!--   <body style="background-color: {{ $colors['backgroundColor'] }}; color: {{ $colors['textColor'] }};">
    <div class="content">
        <img src="/images/cover_PDF@2x.png" alt="Cover Image" style="width: 100%; max-width: 335mm; border: 1px solid #ccc; border-right: none" />

        <div class="uniqueColorB">
            <div class="img imgB">
                <div class="input-drop">
                    @foreach($imageData as $item)
                        @if($item['image']) 
                            <div id="{{ $item['id'] }}">
                                <img src="{{ $item['image'] }}" alt="Image" style="width: 100px; height: 100px;" />
                            </div>
                        @else
                            <div id="{{ $item['id'] }}">{{ $item['id'] }}: No image available</div>
                        @endif
                    @endforeach

                    
                    @foreach($textData as $textItem)
                        <div id="{{ $textItem['id'] }}" class="text-element">
                            {{ $textItem['text'] ?? 'No text available' }}
                        </div>
                    @endforeach

                    <div id="dropAreaB" class="empty droparea"></div>
                </div>
            </div>
        </div>

        <div class="uniqueColor">
            <div class="img imgA">
                <div class="input-drop">
                    
                    @foreach($imageData as $item)
                        @if($item['image']) 
                            <div id="{{ $item['id'] }}">
                                <img src="{{ $item['image'] }}" alt="Image" style="width: 100px; height: 100px;" />
                            </div>
                        @else
                            <div id="{{ $item['id'] }}">{{ $item['id'] }}: No image available</div>
                        @endif
                    @endforeach

                    
                    @foreach($textData as $textItem)
                        <div id="{{ $textItem['id'] }}" class="text-element">
                            {{ $textItem['text'] ?? 'No text available' }}
                        </div>
                    @endforeach
                    
                    <div id="dropAreaA" class="empty droparea"></div>
                </div>
            </div>
        </div>
    </div>
  </body> -->
</html>
