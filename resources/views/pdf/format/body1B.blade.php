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
    <div id="textArea1-1" style="position:absolute; width:{{$textData[0]['width']??'50'}}%; height:{{$textData[0]['height']??'50'}}%; top:{{$textData[0]['top']??'50'}}%; left:{{$textData[0]['left']??'50'}}%; margin:30px 0 0 0; font-size:28.6pt; line-height:1.2; font-weight:bold; text-align:center; color:{{$colors['textColor'] }};">{{$textData[0]['text'] ?? ''}}</div>
    <div id="textArea1-2" style="position:absolute; width:{{$textData[1]['width']??'50'}}%; height:{{$textData[1]['height']??'50'}}%; top:{{$textData[1]['top']??'50'}}%; left:{{$textData[1]['left']??'50'}}%; margin:0; font-size:12pt; text-align:center; line-height:1.5; font-weight:bold; color:{{$colors['textColor'] }};">{{$textData[1]['text'] ?? ''}}</div>
    <div id="frontimg1" class="img-radius" style="position:absolute; width: 45%; height:21%; top:40%; left:27.5%; background-image: url('{{$imageData[0]['image'] }}')"></div>
    <div id="textArea1-3" style="position:absolute; width:{{$textData[2]['width']??'50'}}%; height:{{$textData[2]['height']??'50'}}%; top:{{$textData[2]['top']??'50'}}%; left:{{$textData[2]['left']??'50'}}; font-size:7.5pt; text-align:center;">{{$textData[2]['text'] ?? ''}}</div>

    <pagebreak />

    <img src="{{ asset('img/kotobum_format1/1-2@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
    <div id="textArea2" style="position:absolute; width:{{$textData[3]['width']??'50'}}%; height:{{$textData[3]['height']??'50'}}%; top:{{$textData[3]['top']??'50'}}%; left:{{$textData[3]['left']??'50'}}%; font-size:14pt; line-height:1.5; font-weight:bold; text-align:center; color:{{$colors['textColor'] }};">{{$textData[3]['text'] ?? ''}}</div>
    <div id="frontimg2" class="img-radius" style="position:absolute; width:45%; height:21%; top:41%; left:27.5%; background-image: url('{{$imageData[1]['image'] }}')"></div>

    <pagebreak />

    <img src="{{ asset('img/kotobum_format1/1-3@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
    <div id="textArea3" style="position:absolute; width:{{$textData[4]['width']??'50'}}%; height:{{$textData[4]['height']??'50'}}%; top:{{$textData[4]['top']??'50'}}%; left:{{$textData[4]['left']??'50'}}%; font-size:7.5pt; max-width:38%; text-align:left; ">{{$textData[4]['text'] ?? ''}}</div>

    <pagebreak />

    <img src="{{ asset('img/kotobum_format1/1-4@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
    <div id="textArea4-1" style="position:absolute; width:{{$textData[5]['width']??'50'}}%; height:{{$textData[5]['height']??'50'}}%; top:{{$textData[5]['top']??'50'}}%; left:{{$textData[5]['left']??'50'}}%; font-size:16pt; line-height: 1.5; font-weight: bold; color: #fef8f6; text-align: center; top: 28%;">{{$textData[5]['text'] ?? ''}}</div>
    <div id="frontimg4" class="img-radius" style="position:absolute; width:45%; height:21%; top:36%; left:27.5%; background-image: url('{{$imageData[2]['image'] }}')"></div>
    <div id="textArea4-2" style="position:absolute; width:{{$textData[6]['width']??'50'}}%; height:{{$textData[6]['height']??'50'}}%; top:{{$textData[6]['top']??'50'}}%; left:{{$textData[6]['left']??'50'}}%; font-size:14pt; line-height:1.5; font-weight:bold; color:#fef8f6; text-align:center;">{{$textData[6]['text'] ?? ''}}</div>

    <pagebreak />

    <img src="{{ asset('img/kotobum_format1/1-5@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
    <div id="textArea5" style="position:absolute; width:{{$textData[7]['width']??'50'}}%; height:{{$textData[7]['height']??'50'}}%; top:{{$textData[7]['top']??'50'}}%; left:{{$textData[7]['left']??'50'}}%; font-size:7.5pt; max-width:38%; text-align:left;">{{$textData[7]['text'] ?? ''}}</div>

    <pagebreak />

    <img src="{{ asset('img/kotobum_format1/1-6@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
    <div id="textArea6-1" style="position:absolute; width:{{$textData[8]['width']??'50'}}%; height:{{$textData[8]['height']??'50'}}%; top:{{$textData[8]['top']??'50'}}%; left:{{$textData[8]['left']??'50'}}%; font-size:14pt; line-height:1.5; font-weight:bold; text-align:center; color:{{$colors['textColor'] }};">{{$textData[8]['text'] ?? ''}}</div>
    <div id="frontimg6" class="img-radius" style="position:absolute; width:45%; height:21%; top:41%; left:27.5%; background-image: url('{{$imageData[3]['image'] }}')"></div>

    <pagebreak />

    <img src="{{ asset('img/kotobum_format1/1-7@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
    <div id="textArea7" style="position:absolute; width:{{$textData[9]['width']??'50'}}%; height:{{$textData[9]['height']??'50'}}%; top:{{$textData[9]['top']??'50'}}%; left:{{$textData[9]['left']??'50'}}%; font-size:7.5pt; max-width:38%; text-align:left;">{{$textData[9]['text'] ?? ''}}</div>

    <pagebreak />

    <img src="{{ asset('img/kotobum_format1/1-8@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
    <div id="textArea8" style="position:absolute; width:{{$textData[10]['width']??'50'}}%; height:{{$textData[10]['height']??'50'}}%; top:{{$textData[10]['top']??'50'}}%; left:{{$textData[10]['left']??'50'}}%; font-size:14pt; line-height:1.5; font-weight:bold; text-align:center; color:#fef8f6;">{{$textData[10]['text'] ?? ''}}</div>
    <div id="frontimg8" class="img-radius" style="position:absolute; width:45%; height:21%; top:44.5%; left:27.5%; background-image: url('{{$imageData[4]['image'] }}')"></div>

    <pagebreak />

    <img src="{{ asset('img/kotobum_format1/1-9@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
    <div id="textArea9" style="position:absolute; width:{{$textData[11]['width']??'50'}}%; height:{{$textData[11]['height']??'50'}}%; top:{{$textData[11]['top']??'50'}}%; left:{{$textData[11]['left']??'50'}}%; font-size:7.5pt; max-width:38%; text-align:left;">{{$textData[11]['text'] ?? ''}}</div>

    <pagebreak />

    <img src="{{ asset('img/kotobum_format1/1-10@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
    <div id="textArea10" style="position:absolute; width:{{$textData[12]['width']??'50'}}%; height:{{$textData[12]['height']??'50'}}%; top:{{$textData[12]['top']??'50'}}%; left:{{$textData[12]['left']??'50'}}%; font-size:14pt; line-height:1.5; font-weight:bold; text-align:center; color:{{$colors['textColor'] }};">{{$textData[12]['text'] ?? ''}}</div>
    <div id="frontimg10" class="img-radius" style="position:absolute; width:45%; height:21%; top:41%; left:27.5%; background-image: url('{{$imageData[5]['image'] }}')"></div>

    <pagebreak />

    <img src="{{ asset('img/kotobum_format1/1-11@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />

    <div id="textArea11-1" style="position:absolute; width:{{$textData[13]['width']??'50'}}%; height:{{$textData[13]['height']??'50'}}%; top:{{$textData[13]['top']??'50'}}%; left:{{$textData[13]['left']??'50'}}%; min-width:60%; margin-bottom:5%; margin-top:5%; font-size:7.5pt; line-height:1.5; font-weight:bold; text-align:center; color:{{$colors['textColor'] }};">{{$textData[13]['text'] ?? ''}}</div>
    <div id="textArea11-2" style="position:absolute; width:{{$textData[14]['width']??'50'}}%; height:{{$textData[14]['height']??'50'}}%; top:{{$textData[14]['top']??'50'}}%; left:{{$textData[14]['left']??'50'}}%; min-height:50%; max-height:30%; margin-bottom:2.5%; margin-top:2.5%; font-size:8.3pt;">{{$textData[14]['text'] ?? ''}}</div>

    <pagebreak />

    <img src="{{ asset('img/kotobum_format1/1-12@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />

    <div id="textArea12-1" style="position:absolute; width:{{$textData[15]['width']??'50'}}%; height:{{$textData[15]['height']??'50'}}%; top:{{$textData[15]['top']??'50'}}%; left:{{$textData[15]['left']??'50'}}%; transform: rotate(-8deg); width:34%; text-align:center; font-size:18pt; font-weight:bold; line-height:1.2; color:#fef8f6;">{{$textData[15]['text'] ?? ''}}</div>
    <div id="frontimg12-1" class="img-radius" style="position:absolute; width:28%; height:16%; top:21%; left:18.5%; background-image: url('{{$imageData[6]['image'] }}')"></div>
    <div id="textArea12-2" style="position:absolute; width:{{$textData[16]['width']??'50'}}%; height:{{$textData[16]['height']??'50'}}%; top:{{$textData[16]['top']??'50'}}%; left:{{$textData[16]['left']??'50'}}%; font-size:7.5pt;">{{$textData[16]['text'] ?? ''}}</div>
    <div id="frontimg12-2" class="img-radius" style="position:absolute; width:28%; height:16%; top:39%; left: 18.5%; background-image: url('{{$imageData[7]['image'] }}')"></div>
    <div id="frontimg12-3" class="img-radius" style="position:absolute;width:63%; height:29%; top:58%; left:18.5%; background-image: url('{{$imageData[8]['image'] }}')"></div>
    <div id="textArea12-3" style="width:{{$textData[17]['width']??'50'}}%; height:{{$textData[17]['height']??'50'}}%; top:{{$textData[17]['top']??'50'}}%; left:{{$textData[17]['left']??'50'}}%; text-align:center; line-height:1.5; font-weight:bold; color:#fef8f6; font-size:12.3pt;">{{$textData[17]['text'] ?? ''}}</div>

</body>

</html>
