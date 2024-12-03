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
        switch ($user->format) {
            case 1:
                $format = 'cover1';
                break;
            
            /* case 2
                $format = ''
                break; */
        }

        // ビューにデータを渡す
        return view('pdf.edit', 
                     compact(
                        'format',
                        'textdata',
                        'textdataB', 
                        'colors',
                        'colorsB', 
                        'imageData', 
                        'imageDataB', 
                        'coverstext'));
    }



    public function bodyHTML($userid)
    {
        // データを取得
        $user = User::findOrFail($userid);
        $album = $user->album()->firstOrFail(); // ユーザーのアルバムを取得
        $body = $album->body;  // アルバムに関連する body を取得
    
        // JSONデータを配列にデコード
        $textData = json_decode($body->textdata,true); // trueを設定して連想配列で取得

        $colors = json_decode($body->colors, true);

        $imageData = json_decode($body->imageData, true);

        // 各画像データをBase64形式でエンコード
        foreach ($imageData as &$item) {
            if ($item['image']) {
                // 画像データがバイナリの場合、Base64にエンコード
                $item['image'] = 'data:image/jpeg;base64,' . base64_encode($item['image']);
            }
        }
        
        // 表示するテンプレートの種類を決定
        switch ($user->format) {
            case 1:
                $format = 'body1';
                break;
            
            /* case 2
                $format = ''
                break; */
        }

        // ビューにデータを渡す
        return view('pdf.edit', 
                     compact(
                        'format',
                        'textdata',
                        'textdataB', 
                        'colors',
                        'colorsB', 
                        'imageData', 
                        'imageDataB', ));
    }
    


    public function PDF(Request $request)
    {
        $htmlContent = $request->input('html_content');

        $mpdf = new LaravelMpdf(); //サイズ指定 カバー335、250　ボディ146、206

        // HTMLをPDFに変換
        $mpdf = LaravelMpdf::loadHTML($htmlContent);

        // 表示させる場合
        return $mpdf->stream('document.pdf');

        // ダウンロードさせる場合
        //return $mpdf->download('test.pdf');
    }
}
