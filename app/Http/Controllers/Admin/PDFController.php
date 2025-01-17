<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Album;
use App\Models\Body;
use App\Models\Cover;
use App\Models\User;
use mPDF;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf;
use Meneses\LaravelMpdf\LaravelMpdfServiceProvider;
use Mpdf\Mpdf as MpdfMpdf;

class PDFController extends Controller
{
    public function coverHTML($userid)
    {
        // データを取得
        $user = User::findOrFail($userid);
        $album = $user->album()->firstOrFail(); // ユーザーのアルバムを取得 アルバム大文字？
        $cover = $album->cover;  // アルバムに関連する body を取得
        $coverB = $user->partnerCover()->first(); //パートナーのカバーを取得

        // JSONデータを配列にデコード
        $textData = json_decode($cover->textdata,true); // trueを設定して連想配列で取得
        $textDataB = json_decode($coverB->textdata,true); 
        $colors = json_decode($cover->colors, true);
        $colorsB = json_decode($coverB->colors, true);
        $imageData = json_decode($cover->imageData, true);
        $imageDataB = json_decode($coverB->imageData, true);
        $covertext = json_decode($cover->imageData, true);

        // 各画像データをBase64形式でエンコード
        if (isset($imageData['image']) && !empty($imageData['image'])) {
            $imageData['image'] = 'data:image/jpeg;base64,' . base64_encode($imageData['image']);
        } else {
            $imageData['image'] = null; // 必要に応じてデフォルト値
        }
        if (isset($imageDataB['image']) && !empty($imageDataB['image'])) {
            $imageDataB['image'] = 'data:image/jpeg;base64,' . base64_encode($imageData['image']);
        } else {
            $imageDataB['image'] = null; // 必要に応じてデフォルト値
        }
        
        // 表示するテンプレートの種類を決定
        $format = 'cover1';

        // 表示するテンプレートの種類を決定
        switch ($user->format) {
            case 1:
                $format = 'cover1';
                break;

            // 必要に応じて他のケースを追加
            // case 2:
            //     $format = 'cover2';
            //     break;

            default:
                $format = 'cover1'; // デフォルト値
                break;
}

        // ビューにデータを渡す
        return view('pdf.edit', 
                     compact(
                        'format',
                        'textData',
                        'textDataB', 
                        'colors',
                        'colorsB', 
                        'imageData', 
                        'imageDataB', 
                        'covertext'));
    }



    public function bodyHTML($userid)
    {
        // データを取得
        $user = User::findOrFail($userid);
        $album = $user->album()->firstOrFail(); // ユーザーのアルバムを取得
        $body = $album->body;  // アルバムに関連する body を取得
    
        // JSONデータを配列にデコード
        $textData = json_decode($body->textData,true); // trueを設定して連想配列で取得
        $colors = json_decode($body->colors, true);
        $imageData = json_decode($body->imageData, true);

        // 各画像データをBase64形式でエンコード
        foreach ($imageData as $item) {
            if ($item['image']) {
                // 画像データがバイナリの場合、Base64にエンコード
                $item['image'] = 'data:image/jpeg;base64,' . base64_encode($item['image']);
            }
        }
        
        // 表示するテンプレートの種類を決定
        switch ($user->format) {
            case 1:
                if($user->template === 'A'){
                    $format = 'body1A';
                }else{
                    $format = 'body1B';
                }
                break;
            
            case 2:
                if($user->template === 'A'){
                    $format = 'body2A';
                }else{
                    $format = 'body2B';
                }
                break;
            
            case 3:
                if($user->template === 'A'){
                    $format = 'body3A';
                }else{
                    $format = 'body3B';
                }
                break;

            case 4:
                if($user->template === 'A'){
                    $format = 'body4A';
                }else{
                    $format = 'body4B';
                }
                break;
        }

        // ビューにデータを渡す
        return view('pdf.edit', 
                     compact(
                        'format',
                        'textData',
                        'colors',
                        'imageData',  ));
    }
    


    public function PDF(Request $request)
    {
        $htmlContent = $request->input('html_content');
        $mpdfConfig = config('pdf');
        $customConfig = array_merge($mpdfConfig, [
            'format' => [159, 219] //サイズ指定 カバー335、250　ボディ158、218
        ]);

        $customConfig = array_merge($customConfig, [
            'fontDir' => array_merge(
                (new \Mpdf\Config\ConfigVariables())->getDefaults()['fontDir'],
                [public_path('fonts/')],
            ),
            'fontdata' => (new \Mpdf\Config\FontVariables())->getDefaults()['fontdata'] + [ // フォントデータにカスタムフォントを追加
                'notosansjp' => [
                    'Bo' => 'NotoSansJP-Bold.ttf',
                    'Bl' => 'NotoSansJP-Black.ttf',
                ],
            ],
            'default_font' => 'notosansjp', // デフォルトフォントを指定
        ]);

        $mpdf = LaravelMpdf::loadHTML($htmlContent);
        /* $mpdf->BMPonly[] = 'notosansjp'; */

        /* dump($mpdfConfig);
        dump($customConfig); */
        /* dump($mpdf); */

        // HTMLをPDFに変換
        /* $mpdf->WriteHTML($htmlContent); */
        

        /* dd($htmlContent); */

        // 表示させる場合
        return $mpdf->Output( "MyPDF.pdf", "I");
    }
}
