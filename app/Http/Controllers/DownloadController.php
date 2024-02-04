<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
  public function download(Request $request)
  {
    // データベースから画像のパスを取得する処理（ここでは仮に'demo_thumbnail.png'を使用）
    $imagePath = storage_path('app/public/demo_thumbnail.png');

    // Content-Dispositionヘッダーを含むレスポンスを返す
    $headers = [
      'Content-Disposition' => 'attachment; filename="myVision.png"',
      'Content-Type' => 'image/png', // 画像のMIMEタイプに合わせて適切なContent-Typeを設定
    ];

    // 画像データを直接レスポンスに設定
    $imageData = file_get_contents($imagePath);
    return response($imageData, 200, $headers);
  }
}
