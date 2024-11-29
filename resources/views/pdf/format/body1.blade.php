<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <title>PDFテンプレートinside</title>
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
        text-align: center; /* 水平方向の中央揃え */
      }

      .droparea {
        border: 2px solid #ccc;
        border-radius: 10%;
        position: absolute;
        top: 50%; /* 縦方向の中央 */
        left: 50%; /* 水平方向の中央 */
        transform: translate(-50%, -50%); /* 中央揃え */
        width: 30%;
        height: 35%;
      }
      .dropareaB {
        border: 2px solid #ccc;
        border-radius: 10%;
        position: absolute;
        top: 60%; /* 縦方向の中央 */
        left: 50%; /* 水平方向の中央 */
        transform: translate(-50%, -50%); /* 中央揃え */
        width: 30%;
        height: 35%;
      }
      .textarea {
        /* margin: 5% 0 4%; */
        position: relative;
      }
      .textareaB {
        position: absolute;
      }
      .img {
        position: relative;
      }
      img {
        border: 1px solid #ddd;
      }
      /* ーーー　1ページ　ーーー */
      #dropArea1 {
        /* サーバーから取得 */
        width: 30%;
        height: 35%;
        /* --------------------- */
      }
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
      #dropArea2 {
        /* position: relative; */
        border-radius: 10%;
      }
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
      /* ーーー　5ページ　ーーー */
      /* ーーー　6ページ　ーーー */
      #textArea6-1 {
        font-size: 0.6rem;
        line-height: 1.5;
        font-weight: bold;
        text-align: center;
        top: 26%;
      }

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
      /* ーーー　9ページ　ーーー */
      /* ーーー　10ページ　ーーー */
      #textArea10 {
        font-size: 0.6rem;
        line-height: 1.5;
        font-weight: bold;
        text-align: center;
        top: 27%;
      }
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
        text-orientation: upright; /* 数字や半角文字を縦向きにする */
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
        text-orientation: upright; /* 数字や半角文字を縦向きにする */
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
        max-height: 53%;
        writing-mode: vertical-rl;
        font-size: 8pt;
        text-orientation: upright; /* 数字や半角文字を縦向きにする */
        letter-spacing: 1pt;
      }
      /* ーーー　16ページ　ーーー */
      #textArea16-1,
      #textArea16-2,
      #textArea20 {
        top: 27%;
        min-width: 60%;
        font-size: 0.6rem;
        line-height: 1.5;
        font-weight: bold;
        text-align: center;
        color: #fef8f6;
        text-orientation: upright; /* 数字や半角文字を縦向きにする */
      }
      /* ーーー　17ページ　ーーー */
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
        text-orientation: upright; /* 数字や半角文字を縦向きにする */
      }
      #textArea23-2 {
        min-height: 50%;
        max-height: 30%;
        margin-bottom: 2.5%;
        margin-top: 2.5%;
        font-size: 0.33rem;
        top: 17%;
        text-orientation: upright; /* 数字や半角文字を縦向きにする */
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
        text-orientation: upright; /* 数字や半角文字を縦向きにする */
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
        text-orientation: upright; /* 数字や半角文字を縦向きにする */
      }
      #dropArea24-1 {
        position: relative;
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
  <body class="edit-body">
    <div class="content">
      <!-- ーーーー　B面　ーーーー -->
      <div class="uniqueColor">
        <div class="img">
          <img src="public/kotobamu_format1/p1@2x.png" alt="テンプレート画像" style="width: 100%; max-width: 600px" />
          <div class="input-drop">
            <div id="textArea1-1" class="text-empty text-color textarea">サーバーから取得</div>
            <div id="textArea1-2" class="text-empty text-color textarea">サーバーから取得</div>
            <div id="dropArea1" class="empty droparea"></div>
            <div id="textArea1-3" class="text-empty textarea">サーバーから取得</div>
          </div>
        </div>
      </div>
      <div class="uniqueColor">
        <div class="img">
          <img src="public/kotobamu_format1/p2@2x.png" alt="" style="width: 100%; max-width: 600px" />
          <div class="input-drop">
            <div id="textArea2" class="text-empty text-color textarea">サーバーから取得</div>
            <div id="dropArea2" class="empty droparea"></div>
          </div>
        </div>
      </div>
      <div class="uniqueColor">
        <div class="img">
          <img src="public/kotobamu_format1/p3@2x.png" alt="" style="width: 100%; max-width: 600px" />
          <div class="input-drop">
            <div id="textArea3" class="text-empty textarea">サーバーから取得</div>
          </div>
        </div>
      </div>
      <div class="uniqueColor">
        <div class="img">
          <img src="public/kotobamu_format1/p4@2x.png" alt="" style="width: 100%; max-width: 600px" />
          <div class="input-drop">
            <div id="textArea4-1" class="text-empty textarea">サーバーから取得</div>
            <div id="dropArea4" class="empty droparea"></div>
            <div id="textArea4-2" class="text-empty textarea">サーバーから取得</div>
          </div>
        </div>
      </div>
      <div class="uniqueColor">
        <div class="img">
          <img src="public/kotobamu_format1/p5@2x.png" alt="" style="width: 100%; max-width: 600px" />
          <div class="input-drop">
            <div id="textArea5" class="text-empty textarea">サーバーから取得</div>
          </div>
        </div>
      </div>
      <div class="uniqueColor">
        <div class="img">
          <img src="public/kotobamu_format1/p8@2x.png" alt="" style="width: 100%; max-width: 600px" />
          <div class="input-drop">
            <div id="textArea6-1" class="text-empty text-color textarea">サーバーから取得</div>
            <div id="dropArea6" class="empty droparea"></div>
          </div>
        </div>
      </div>
      <div class="uniqueColor">
        <div class="img">
          <img src="public/kotobamu_format1/p7@2x.png" alt="" style="width: 100%; max-width: 600px" />
          <div class="input-drop">
            <div id="textArea7" class="text-empty textarea">サーバーから取得</div>
          </div>
        </div>
      </div>
      <div class="uniqueColor">
        <div class="img">
          <img src="public/kotobamu_format1/p8-AB@2x.png" alt="" style="width: 100%; max-width: 600px" />
          <div class="input-drop">
            <div id="textArea8" class="text-empty textarea">サーバーから取得</div>
            <div id="dropArea8" class="empty droparea"></div>
          </div>
        </div>
      </div>
      <div class="uniqueColor">
        <div class="img">
          <img src="public/kotobamu_format1/p9@2x.png" alt="" style="width: 100%; max-width: 600px" />
          <div class="input-drop">
            <div id="textArea9" class="text-empty textarea">サーバーから取得</div>
          </div>
        </div>
      </div>
      <div class="uniqueColor">
        <div class="img">
          <img src="public/kotobamu_format1/p10@2x.png" alt="" style="width: 100%; max-width: 600px" />
          <div class="input-drop">
            <div id="textArea10" class="text-empty text-color textarea">サーバーから取得</div>
            <div id="dropArea10" class="empty droparea"></div>
          </div>
        </div>
      </div>
      <div class="uniqueColor">
        <div class="img">
          <img src="public/kotobamu_format1/p11@2x.png" alt="" style="width: 100%; max-width: 600px" />
          <div class="input-drop">
            <div id="textArea11-1" class="text-empty text-color textarea">サーバーから取得</div>
            <div id="textArea11-2" class="text-empty textarea">サーバーから取得</div>
          </div>
        </div>
      </div>
      <div class="uniqueColor">
        <div class="img">
          <img src="public/kotobamu_format1/p12@2x.png" alt="" style="width: 100%; max-width: 600px" />
          <div class="input-drop">
            <div id="textArea12-1" class="text-empty text-diagonal textarea">サーバーから取得</div>
            <div id="dropArea12-1" class="empty"></div>
            <div id="textArea12-2" class="text-empty textarea">サーバーから取得</div>
            <div id="dropArea12-2" class="empty"></div>
            <div id="dropArea12-3" class="empty"></div>

            <div id="textArea12-3" class="text-empty textarea">サーバーから取得</div>
          </div>
        </div>
      </div>

      <!-- ーーーー　A面　ーーーー -->
      <div class="uniqueColorB">
        <div class="img">
          <img src="public/kotobamu_format1/p13@2x.png" alt="" style="width: 100%; max-width: 600px" />
          <div class="input-drop">
            <div id="textArea24-1" class="text-empty text-colorB textarea">サーバーから取得</div>
            <div id="dropArea24-1" class="empty"></div>
            <div id="dropArea24-2" class="empty"></div>
            <div id="textArea24-2" class="text-empty textarea">サーバーから取得</div>
            <div id="dropArea24-3" class="empty"></div>
            <div id="textArea24-4" class="text-empty textareaB">サーバーから取得</div>
          </div>
        </div>
      </div>
      <div class="uniqueColorB">
        <div class="img">
          <img src="public/kotobamu_format1/p14@2x.png" alt="" style="width: 100%; max-width: 600px" />
          <div class="input-drop">
            <div id="textArea23-1" class="text-empty text-colorB textarea">サーバーから取得</div>
            <div id="textArea23-2" class="text-empty textarea">サーバーから取得</div>
          </div>
        </div>
      </div>
      <div class="uniqueColorB">
        <div class="img">
          <img src="public/kotobamu_format1/p15@2x.png" alt="" style="width: 100%; max-width: 600px" />
          <div class="input-drop">
            <div id="textArea22" class="text-empty text-colorB textarea">サーバーから取得</div>
            <div id="dropArea22" class="empty dropareaB"></div>
          </div>
        </div>
      </div>
      <div class="uniqueColorB">
        <div class="img">
          <img src="public/kotobamu_format1/p16@2x.png" alt="" style="width: 100%; max-width: 600px" />
          <div class="input-drop">
            <div id="textArea21" class="text-empty textareaB">サーバーから取得</div>
          </div>
        </div>
      </div>
      <div class="uniqueColorB">
        <div class="img">
          <img src="public/kotobamu_format1/p8-AB@2x.png" alt="" style="width: 100%; max-width: 600px" />
          <div class="input-drop">
            <div id="textArea20" class="text-empty textarea">サーバーから取得</div>
            <div id="dropArea20" class="empty droparea"></div>
          </div>
        </div>
      </div>
      <div class="uniqueColorB">
        <div class="img">
          <img src="public/kotobamu_format1/p18@2x.png" alt="" style="width: 100%; max-width: 600px" />
          <div class="input-drop">
            <div id="textArea19" class="text-empty textareaB">サーバーから取得</div>
          </div>
        </div>
      </div>
      <div class="uniqueColorB">
        <div class="img">
          <img src="public/kotobamu_format1/p8@2x.png" alt="" style="width: 100%; max-width: 600px" />
          <div class="input-drop">
            <div id="textArea18" class="text-empty textarea">サーバーから取得</div>
            <div id="dropArea18" class="empty dropareaB"></div>
          </div>
        </div>
      </div>
      <div class="uniqueColorB">
        <div class="img">
          <img src="public/kotobamu_format1/p20@2x.png" alt="" style="width: 100%; max-width: 600px" />
          <div class="input-drop">
            <div id="textArea17" class="text-empty textareaB">サーバーから取得</div>
          </div>
        </div>
      </div>
      <div class="uniqueColorB">
        <div class="img">
          <img src="public/kotobamu_format1/p21@2x.png" alt="" style="width: 100%; max-width: 600px" />
          <div class="input-drop">
            <div id="textArea16-1" class="text-empty textarea">サーバーから取得</div>
            <div id="dropArea16" class="empty droparea"></div>
            <div id="textArea16-2" class="text-empty textarea">サーバーから取得</div>
          </div>
        </div>
      </div>
      <div class="uniqueColorB">
        <div class="img">
          <img src="public/kotobamu_format1/p22@2x.png" alt="" style="width: 100%; max-width: 600px" />
          <div class="input-drop">
            <div id="textArea15" class="text-empty textareaB">サーバーから取得</div>
          </div>
        </div>
      </div>
      <div class="uniqueColorB">
        <div class="img">
          <img src="public/kotobamu_format1/p23@2x.png" alt="" style="width: 100%; max-width: 600px" />
          <div class="input-drop">
            <div id="textArea14" class="text-empty text-colorB textarea">サーバーから取得</div>
            <div id="dropArea14" class="empty dropareaB"></div>
          </div>
        </div>
      </div>
      <div class="uniqueColorB">
        <div class="img">
          <img src="public/kotobamu_format1/p24@2x.png" alt="" style="width: 100%; max-width: 600px" />
          <div class="input-drop">
            <div id="textArea13-1" class="text-empty text-colorB textarea">サーバーから取得</div>
            <div id="textArea13-2" class="text-empty text-colorB textarea">サーバーから取得</div>
            <div id="dropArea13" class="empty droparea"></div>
            <div id="textArea13-3" class="text-empty textareaB">サーバーから取得</div>
          </div>
        </div>
      </div>

      <!-- content -->
    </div>
  </body>
</html>
