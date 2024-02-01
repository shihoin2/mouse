<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Board;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;

class VisionController extends Controller
{
  /**
   * ユーザーのボード全件取得
   *
   * My Vision Board での表示 → クリックで個々の board を表示
   */
  public function index()
  {
    //
  }

  /**
   * 新規ボードの生成 → 保存
   *
   * ホーム画面でテンプレートを選択し、propsとして情報を渡す
   * create 画面で props をもとに該当のテンプレートを表示＆新規保存
   */
  public function create()
  {
    //
  }

  /**
   * 画像の保存
   * board_idを取得して保存
   */
  // public function imageStore(Request $request, $id)
  public function imageStore(Request $request)
  {
    //id受け渡しのとき
      if ($request->hasFile('image')) {
          $file_name = $request->file('image')->getClientOriginalName();
          $file_path = $request->file('image')->storeAs('', $file_name);

          $image = new Image();
          $image->image_name = $file_name;
          $image->image_path = $file_path;

          $image->save();

          $image = Image::latest()->first();
          $imagePath = $image->image_path;
          $imageUrl = asset('storage/' . $imagePath);
          return response()->json(['image_url' => $imageUrl]);
      } else {

      }
  }
  /**
   * 画像の保存
   * board_idを取得して保存
   */
  // public function thumbnailStore(Request $request)
  public function thumbnailPatch(Request $request)
{
    if ($request->has('image')) {
        // データURLから画像ファイルを作成
        $imageData = $request->input('image');
        $imageData = str_replace('data:image/png;base64,', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);
        $imageBinary = base64_decode($imageData);

        // 一意のファイル名を生成
        $fileName = uniqid() . '.png';

        // ファイル保存
        $filePath = 'public/thumbnails/' . $fileName;
        Storage::put($filePath, $imageBinary);

        // データベースに保存一部を更新するには、save()ではなくupdate
        Board::where('id', 5)->update([
          'board_thumbnail' => $fileName,
          'updated_at' => now(), // 更新日時を現在の日時に設定
      ]);
        return response()->json(['message' => 'Image saved successfully', 'board_thumbnail' => $fileName]);
    } else {
        return response()->json(['message' => 'No image data received'], 400);
    }
}

  /**
   * ボードの更新
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * ボードの削除
   */
  public function destroy(string $id)
  {
    //
  }
}
