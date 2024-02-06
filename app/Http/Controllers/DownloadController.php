<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function download(Request $request)
    {
        // クエリパラメータから取得したURLから画像のPath作成
        // DBのパスを変更すれば簡潔に書けるが、フロントやDBを少し変えないといけないため今回はこれでよしとする
        $imagePath = storage_path('app/public/' . substr($request->query('imageUrl'), 25));
        // file_get_contentsで画像のバイナリデータ取得 base64_encodeでbase64に変換
        $base64 = base64_encode(file_get_contents($imagePath));
        return response()->json($base64);
    }
}
