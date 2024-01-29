<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
