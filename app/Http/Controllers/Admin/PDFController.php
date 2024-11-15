<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Body;
use App\Models\Cover;
use App\Models\User;
use mPDF;

class PDFController extends Controller
{
    public function coverHTML($userid)
    {
        /* // データを取得
        $user = User::findOrFail($userid);
        $album = $user->albums()->firstOrFail(); // ユーザーのアルバムを取得
        $cover = $album->cover;  // アルバムに関連する body を取得 */
        
        // 表示するテンプレートの種類を決定
        // $format = 'template1'; // 条件によって変更//

        // ビューにデータを渡す
        return view('pdf.edit'/* , compact('cover', 'template') */);
    }


    public function bodyHTML($userid)
    {
        // データを取得
        /* $user = User::findOrFail($userid);
        $album = $user->albums()->firstOrFail(); // ユーザーのアルバムを取得
        $cover = $album->cover;  // アルバムに関連する body を取得 */
    
        // 表示するテンプレートの種類を決定
        // $format = 'template1'; // 条件によって変更

        // ビューにデータを渡す
        return view('pdf.edit'/* , compact('Body', 'template') */);

    }
    

    public function PDF(Request $request)
    {
        $htmlContent = $request->input('html_content');

        // mPDFインスタンスを作成し、HTMLをPDFに変換
        $mpdf = mPDF::loadHTML($htmlContent);

        // 表示させる場合
        return $mpdf->stream('document.pdf');

        // ダウンロードさせる場合
        //return $pdf->download('test.pdf');
    }
}
