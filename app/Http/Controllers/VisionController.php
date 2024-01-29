<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
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
  public function imageStore(Request $request, $id)
  {
    // 保存するディレクトリ名
    $dir = 'sample';
    //getClientOriginalNameメソッドでアップロードされたファイル名を取得
    $file_name = $requst->file('image')->getClientOriginalName();

    // アップロードされたファイルをpublic/sampleに取得したファイル名で保存
    $request->file('image')->storeAs('public/' . $dir, $file_name);

    //ファイル情報をDBに保存
    $image = new Image();
    $image->image_name = $file_name;
    $image->save();
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
