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
    <img src="{{ asset('img/kotobum_format1/2-12@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
    <div id="textArea24-1" style="position:absolute; width:{{$textData[0]['width']??'50'}}%; height:{{$textData[0]['height']??'50'}}%; top:{{$textData[0]['top']??'50'}}%; left:{{$textData[0]['left']??'50'}}%; text-orientation:upright; font-size:13pt; line-height:1; text-align:center; font-weight: bold; color:{{$colors['textColor'] ?? '#000000'}};">{{$textData[0]['text'] ?? ''}}</div>
    <div id="frontimg24-1" style="position:absolute; width:29.25%; height:17.83%; top:14.37%; left:17.5%; background-size: contain; background-repeat: no-repeat; background-position: center; background-image: url('{{$imageData[0]['image'] }}');"></div>
    <div id="frontimg24-2" style="position:absolute; width:29.25%; height:17.83%; top:34.85%; left: 17.5%; background-size: contain; background-repeat: no-repeat; background-position: center; background-image: url('{{$imageData[1]['image'] }}');"></div>
    <div id="textArea24-2" style="position:absolute; width:{{$textData[1]['width']??'50'}}%; height:{{$textData[1]['height']??'50'}}%; top:{{$textData[1]['top']??'50'}}%; left:{{$textData[1]['left']??'50'}}%; writing-mode:vertical-rl; font-size:7.5pt; text-orientation:upright;">{{$textData[1]['text'] ?? ''}}</div>
    <div id="frontimg24-3" style="position:absolute; width:65%; height:29.8%; top:55.56%; left:15.5%; background-size: contain; background-repeat: no-repeat; background-position: center; background-image: url('{{$imageData[2]['image'] }}');"></div>
    <div id="textArea24-4" style="position:absolute; width:{{$textData[2]['width']??'50'}}%; height:{{$textData[2]['height']??'50'}}%; top:{{$textData[2]['top']??'50'}}%; left:{{$textData[2]['left']??'50'}}%; text-orientation:upright; text-align:center; line-height:1.5; font-weight:bold; color:#fef8f6; font-size:12.3pt; ">{{$textData[2]['text'] ?? ''}}</div>








    <pagebreak />




    <img src="{{ asset('img/kotobum_format1/2-11@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />    <div id="textArea23-2" style="position:absolute; width:48%; height:{{$textData[3]['height']??'50'}}%; top:{{$textData[3]['top']??'50'}}%; left:27%; text-orientation:upright; font-size: 7.5pt;">{{$textData[3]['text'] ?? ''}}</div>








    <pagebreak />




    <img src="{{ asset('img/kotobum_format1/2-10@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
    <div id="textArea22" style="position:absolute; width:{{$textData[4]['width']??'50'}}%; height:{{$textData[4]['height']??'50'}}%; top:22%; left:{{$textData[4]['left']??'50'}}%; color:{{$colors['textColor'] ?? '#000000'}}; font-size:14pt; line-height: 1.5; text-align:center; font-weight:bold;">{{$textData[4]['text'] ?? ''}}</div>
    <div id="frontimg22" class="img-radius" style="position:absolute; width:48%; height:45.31%; top:27.94%; left:26%;background-size: contain; background-repeat: no-repeat; background-position: center;background-image: url('{{$imageData[3]['image'] }}')"></div>




    <pagebreak />




    <img src="{{ asset('img/kotobum_format1/2-9@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
    <div id="textArea21" style="position:absolute; width:57%; height:{{$textData[5]['height']??'50'}}%; top:{{$textData[5]['top']??'50'}}%; left:22%; writing-mode:vertical-rl; font-size:7.5pt;letter-spacing:1pt;">{{$textData[5]['text'] ?? ''}}</div>








    <pagebreak />




    <img src="{{ asset('img/kotobum_format1/2-8@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
    <div id="textArea20" style="position:absolute; width:{{$textData[6]['width']??'50'}}%; height:{{$textData[6]['height']??'50'}}%; top:{{$textData[6]['top']??'50'}}%; left:{{$textData[6]['left']??'50'}}%; font-size:14pt; line-height:1.5; font-weight:bold; text-align:center; color:#fef8f6; text-orientation:upright;">{{$textData[6]['text'] ?? ''}}</div>
    <div id="frontimg20" class="img-radius" style="position:absolute; width:50%; height:37.61%; top:33.5%; left:25%; background-size: contain; background-repeat: no-repeat; background-position: center; background-image: url('{{$imageData[4]['image'] }}')"></div>




    <pagebreak />




    <img src="{{ asset('img/kotobum_format1/2-7@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
    <div id="textArea19" style="position:absolute; width:51%; height:{{$textData[7]['height']??'50'}}%; top:{{$textData[7]['top']??'50'}}%; left:25%; writing-mode:vertical-rl; font-size:7.5pt; text-orientation:upright; letter-spacing:1pt;">{{$textData[7]['text'] ?? ''}}</div>




    <pagebreak />




    <img src="{{ asset('img/kotobum_format1/2-6@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
    <div id="textArea18" style="position:absolute; width:{{$textData[8]['width']??'50'}}%; height:{{$textData[8]['height']??'50'}}%; top:{{$textData[8]['top']??'50'}}%; left:{{$textData[8]['left']??'50'}}%; color:{{$colors['textColor'] ?? '#000000'}}; font-size:14pt; line-height: 1.5; text-align:center; font-weight:bold; text-orientation:upright;">{{$textData[8]['text'] ?? ''}}</div>
    <div id="frontimg18" class="img-radius" style="position:absolute; width:50%; height:41.04%; top:29.22%; left:25%; background-size: contain; background-repeat: no-repeat; background-position: center; background-image: url('{{$imageData[5]['image'] }}')"></div>




    <pagebreak />




    <img src="{{ asset('img/kotobum_format1/2-5@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
    <div id="textArea17" style="position:absolute; width:50%; height:{{$textData[9]['height']??'50'}}%; top:{{$textData[9]['top']??'50'}}%; left:26%; text-align:justify; font-size:7.5pt; text-orientation:upright; letter-spacing:1pt;">{{$textData[9]['text'] ?? ''}}</div>




    <pagebreak />




    <img src="{{ asset('img/kotobum_format1/1-4@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
    <div id="textArea16-1" style="position:absolute; width:{{$textData[10]['width']??'50'}}%; height:{{$textData[10]['height']??'50'}}%; top:{{$textData[10]['top']??'50'}}%; left:{{$textData[10]['left']??'50'}}%; font-size:16pt; line-height:1.5; font-weight:bold; text-align:center; color:#fef8f6; text-orientation:upright;">{{$textData[10]['text'] ?? ''}}</div>
    <div id="frontimg16" class="img-radius" style="position:absolute; width:48%; height:31.63%; top:30.51%; left:26%; background-size: contain; background-repeat: no-repeat; background-position: center; background-image: url('{{$imageData[6]['image'] }}')"></div>
    <div id="textArea16-2" style="position:absolute; width:{{$textData[11]['width']??'50'}}%; height:{{$textData[11]['height']??'50'}}%; top:{{$textData[11]['top']??'50'}}%; left:{{$textData[11]['left']??'50'}}%; font-size:14pt; line-height:1.5; font-weight:bold; text-align:center; color:#fef8f6; text-orientation:upright;">{{$textData[11]['text'] ?? ''}}</div>




    <pagebreak />








    <img src="{{ asset('img/kotobum_format1/1-3@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
    <div id="textArea15" style="position:absolute; width:70%; height:{{$textData[12]['height']??'50'}}%; top:{{$textData[12]['top']+5??'50'}}%; left:15%; text-align:justify; font-size:7.5pt; text-orientation:upright; letter-spacing:1pt;">{{$textData[12]['text'] ?? ''}}</div>




    <pagebreak />




    <img src="{{ asset('img/kotobum_format1/1-2@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
    <div id="textArea14" style="position:absolute; width:{{$textData[13]['width']??'50'}}%; height:{{$textData[13]['height']??'50'}}%; top:31%; left:20%; color:{{$colors['textColor'] ?? '#000000'}}; font-size:16pt; line-height: 1.5; text-align:center; font-weight:bold; text-orientation:upright;">{{$textData[13]['text'] ?? ''}}</div>
    <div id="frontimg14" class="img-radius" style="position:absolute; width:50%; height:28.21%; top:36.49%; left:25%; background-size: contain; background-repeat: no-repeat; background-position: center; background-image: url('{{$imageData[7]['image'] }}')"></div>




    <pagebreak />




    <img src="{{ asset('img/kotobum_format1/1-1@2x.png') }}" alt="" style="width: 158mm; height:218mm;" />
    <div id="textArea13-1" style="position:absolute; width:{{$textData[14]['width']??'50'}}%; height:{{$textData[14]['height']??'50'}}%; top:16.5%; left:{{$textData[14][left]??'50'}}%; color:{{$colors['textColor'] ?? '#000000'}}; margin:30px 0 0 0; font-size:28.6pt; line-height:1.2; font-weight:bold; text-align:center;">{{$textData[14]['text'] ?? ''}}</div>
    <div id="textArea13-2" style="position:absolute; width:{{$textData[15]['width']??'50'}}%; height:{{$textData[15]['height']??'50'}}%; top:27.67%; left:{{$textData[15][left]??'50'}}%; color:#fef8f6; font-size:12pt; text-align:center; line-height:1.5; font-weight:bold;">{{$textData[15]['text'] ?? ''}}</div>
    <div id="frontimg13" class="img-radius" style="position:absolute; width:50%; height:33.34%; top:33.29%; left:25%; background-size: contain; background-repeat: no-repeat; background-position: center; background-image: url('{{$imageData[8]['image'] }}')"></div>
    <div id="textArea13-3" style="position:absolute;width:{{$textData[16]['width']??'50'}}%; height:{{$textData[16]['height']??'50'}}%; top:70.05%; left:20%; font-size:7.5pt; text-orientation:upright;">{{$textData[16]['text'] ?? ''}}</div>




</body>




</html>