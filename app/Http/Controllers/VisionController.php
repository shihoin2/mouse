<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
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
  public function imageStore(Request $request, $id)
  { //  画像がある場合
    if ($request->hasFile('image'))
    {
      //getClientOriginalNameメソッドでアップロードされたファイル名を取得
      $file_name = $requst->file('image')->getClientOriginalName();
      //Storage::pathへ引数にstorage以下の相対パスをいれることで、ディレクトリのフルパスを取得できる
      $file_path = Storage::path('app/public/images');

      //Storageを使用し、任意の名前での画像の保存。'public'はconfigs/filesystem.phpに設定が書いてある。strage/app/public/imagesに保存
      Storage::putFileAs('public' . '/images', $request->file('iamge'), $file_name);

      $image = new Image();
      $image -> image_name = $file_name;
      $image -> image_path = $file_path . '/' . $file_name;
      $image ->save();
    } else {
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
