<!DOCTYPE html>
<html lang="ja">


<head>
    <meta charset="UTF-8" />
    <title>PDFテンプレートinside</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }


        .img-radius {
            border-radius: 15pt;
        }
    </style>
</head>


<body style="background-color:{{$colors['backgroundColor'] ?? '#000000' }}; text-align:center; font-family:notosansjp,sans-serif;">


    <img src="{{ asset('img/kotobum_format1/1-1@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
    <div id="textArea1-1" style="family:leaguespartan; position:absolute; width:{{$textData[0]['width']??'50'}}%; height:{{$textData[0]['height']??'50'}}%; top:16.8%; left:20%;  margin:30px 0 0 0; font-size:28.6pt; line-height:1.2; font-weight:bold; text-align:center; color:{{$colors['textColor'] }};">{{$textData[0]['text'] ?? ''}}</div>
    <div id="textArea1-2" style="position:absolute; width:{{$textData[1]['width']??'50'}}%; height:{{$textData[1]['height']??'50'}}%; top:27.67%; left:32%; margin:0; font-size:12pt; text-align:center; line-height:1.5; font-weight:bold; color:{{$colors['textColor'] }};">{{$textData[1]['text'] ?? ''}}</div>
    <div id="frontimg1" class="img-radius" style="position:absolute; width:50%; height:33.34%; top:34.29%; left:25%; background-size: contain; background-repeat: no-repeat; background-position: center; background-image: url('{{$imageData[0]['image'] }}')"></div>
    <div id="textArea1-3" style="position:absolute; width:52%; height:{{$textData[2]['height']??'50'}}%; top:69.5%; left:24.5%;font-size:7.5pt; text-align:left; line-height:2;">{{$textData[2]['text'] ?? ''}}</div>


    <pagebreak />


    <img src="{{ asset('img/kotobum_format1/1-2@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
    <div id="textArea2" style="position:absolute; width:{{$textData[3]['width']??'50'}}%; height:{{$textData[3]['height']??'50'}}%; top:{{$textData[3]['top']??'50'}}%; left:20%; font-size:14pt; line-height:1.5; font-weight:bold; text-align:center; color:{{$colors['textColor'] }};">{{$textData[3]['text'] ?? ''}}</div>
   <div id="frontimg2" class="img-radius" style="position:absolute; width:50%; height:28.21%; top:{{$imageData[1]['top']??'50'}}%; left:25%; background-size: contain; background-repeat: no-repeat; background-position: center; background-image: url('{{$imageData[1]['image'] }}')"></div>


    <pagebreak />


    <img src="{{ asset('img/kotobum_format1/1-3@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
    <div id="textArea3" style="position:absolute; width:51%; height:{{$textData[4]['height']+1 ??'50'}}%; top:{{$textData[4]['top']+1 ??'50'}}%; left:25%; font-size:7.5pt; text-align:left; line-height:2; letter-spacing:1.5;">{{$textData[4]['text'] ?? ''}}</div>




    <pagebreak />


    <img src="{{ asset('img/kotobum_format1/1-4@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
    <div id="textArea4-1" style="position:absolute; width:{{$textData[5]['width']??'50'}}%; height:{{$textData[5]['height']+1 ??'50'}}%; top:{{$textData[5]['top']??'50'}}%; left:{{$textData[5]['left']??'50'}}%; font-size:16pt; line-height: 1.5; font-weight: bold; color: #fef8f6; text-align: center;">{{$textData[5]['text'] ?? ''}}</div>
    <div id="frontimg4" class="img-radius" style="position:absolute; width:48%; height:31.63%; top:{{$imageData[2]['top']??'50'}}%; left:26%; background-size: contain; background-repeat: no-repeat; background-position: center; background-image: url('{{$imageData[2]['image'] }}')"></div>
    <div id="textArea4-2" style="position:absolute; width:{{$textData[6]['width']??'50'}}%; height:{{$textData[6]['height']??'50'}}%; top:{{$textData[6]['top']??'50'}}%; left:{{$textData[6]['left']??'50'}}%; font-size:14pt; line-height:1.5; font-weight:bold; color:#fef8f6; text-align:center;">{{$textData[6]['text'] ?? ''}}</div>


    <pagebreak />


    <img src="{{ asset('img/kotobum_format1/1-5@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
    <div id="textArea5" style="position:absolute; width:51%; height:{{$textData[7]['height']??'50'}}%; top:{{$textData[7]['top']??'50'}}%; left:25%; font-size:7.5pt; text-align:left; letter-spacing:1.5; line-height:2;">{{$textData[7]['text'] ?? ''}}</div>




    <pagebreak />


    <img src="{{ asset('img/kotobum_format1/1-6@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
    <div id="textArea6-1" style="position:absolute; width:{{$textData[8]['width']??'50'}}%; height:{{$textData[8]['height']??'50'}}%; top:{{$textData[8]['top']+2 ??'50'}}%; left:{{$textData[8]['left']??'50'}}%; font-size:14pt; line-height:1.5; font-weight:bold; text-align:center; color:{{$colors['textColor'] }};">{{$textData[8]['text'] ?? ''}}</div>
    <div id="frontimg6" class="img-radius" style="position:absolute; width:50%; height:41.04%; top:{{$imageData[3]['top']??'50'}}%; left:25%; background-size: contain; background-repeat: no-repeat; background-position: center; background-image: url('{{$imageData[3]['image'] }}')"></div>


    <pagebreak />


    <img src="{{ asset('img/kotobum_format1/1-7@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
    <div id="textArea7" style="position:absolute;  width:51%; height:{{$textData[9]['height']??'50'}}%; top:{{$textData[9]['top']??'50'}}%; left:25%; font-size:7.5pt;text-align:left;  letter-spacing:1.5; line-height:2;">{{$textData[9]['text'] ?? ''}}</div>




    <pagebreak />


    <img src="{{ asset('img/kotobum_format1/1-8@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
    <div id="textArea8" style="position:absolute; width:{{$textData[10]['width']??'50'}}%; height:{{$textData[10]['height']??'50'}}%; top:{{$textData[10]['top']??'50'}}%; left:{{$textData[10]['left']??'50'}}%; font-size:14pt; line-height:1.5; font-weight:bold; text-align:center; color:#fef8f6;">{{$textData[10]['text'] ?? ''}}</div>
    <div id="frontimg8" class="img-radius" style="position:absolute; width:50%; height:37.61%;  top:{{$imageData[4]['top']??'50'}}%; left:25%; background-size: contain; background-repeat: no-repeat; background-position: center; background-image: url('{{$imageData[4]['image'] }}')"></div>




    <pagebreak />


    <img src="{{ asset('img/kotobum_format1/1-9@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
    <div id="textArea9" style="position:absolute; width:51%; height:{{$textData[11]['height']??'50'}}%; top:{{$textData[11]['top']??'50'}}%; left:25%; font-size:7.5pt; text-align:left; letter-spacing:1.2; line-height:2;">{{$textData[11]['text'] ?? ''}}</div>




    <pagebreak />


    <img src="{{ asset('img/kotobum_format1/1-10@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
    <div id="textArea10" style="position:absolute; width:{{$textData[12]['width']??'50'}}%; height:{{$textData[12]['height']??'50'}}%; top:22%; left:{{$textData[12]['left']??'50'}}%; font-size:14pt; line-height:1.5; font-weight:bold; text-align:center; color:{{$colors['textColor'] }};">{{$textData[12]['text'] ?? ''}}</div>
    <div id="frontimg10" class="img-radius" style="position:absolute; width:48%; height:45.31%; top:{{$imageData[5]['top']??'50'}}%; left:26%; background-size: contain; background-repeat: no-repeat; background-position: center; background-image: url('{{$imageData[5]['image'] }}')"></div>




    <pagebreak />




    <img src="{{ asset('img/kotobum_format1/1-11@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
    <div id="textArea11-2" style="position:absolute; width:51%; height:{{$textData[13]['height']??'50'}}%; top:{{$textData[13]['top']??'50'}}%; left:25%; font-size:7.5pt; letter-spacing:1.2; line-height:2;">{{$textData[13]['text'] ?? ''}}</div>




    <pagebreak />




    <img src="{{ asset('img/kotobum_format1/1-12@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />


    <div id="textArea12-1" style="font-family:montserrat; position:absolute; width:{{$textData[14]['width']??'50'}}%; height:{{$textData[14]['height']??'50'}}%;  top:{{$textData[14]['top']??'50'}}%; left:{{$textData[14]['left']??'50'}}%; transform: rotate(-8deg); width:34%; text-align:center; font-size:18pt; font-weight:bold; line-height:1; color:#fef8f6;">{{$textData[14]['text'] ?? ''}}</div>
    <div id="frontimg12-1" style="position:absolute; width:68.5%; height:29.5%; top:15.864%; right:16.5%; background-size: contain; background-repeat: no-repeat; background-position: center; background-image: url('{{$imageData[6]['image'] }}')"></div>
    <div id="textArea12-2" style="position:absolute; width:{{$textData[15]['width']+5 ??'50'}}%; height:{{$textData[15]['height']??'50'}}%; top:{{$textData[15]['top']??'50'}}%; left:{{$textData[15]['left']-3 ??'50'}}%; font-size:7.5pt; letter-spacing:1.2; line-height:2;">{{$textData[15]['text'] ?? ''}}</div>
    <div id="frontimg12-2" style="position:absolute; width:27%; height:17.5%; top:48.57%; right: 16.5%; background-size: contain; background-repeat: no-repeat; background-position: center; background-image: url('{{$imageData[7]['image'] }}')"></div>
    <div id="frontimg12-3" style="position:absolute; width:27%; height:17.5%; top:69.06%; right: 16.5%; background-size: contain; background-repeat: no-repeat; background-position: center; background-image: url('{{$imageData[8]['image'] }}')"></div>
    <div id="textArea12-3" style="position:absolute; font-family:montserrat; width:{{$textData[16]['width']??'50'}}%; height:{{$textData[16]['height']+1 ??'50'}}%; top:{{$textData[16]['top']-0.6 ??'50'}}%; left:{{$textData[16]['left']??'50'}}%; text-align:center; line-height:1.5; font-weight:bold; color:#fef8f6; font-size:12.3pt;">{{$textData[16]['text'] ?? ''}}</div>


</body>


</html>


