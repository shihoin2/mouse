<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use Illuminate\Http\Exceptions\HttpResponseException;


class VisionController extends Controller
{
  /**
   * ユーザーのボード全件取得
   *
   * My Vision Board での表示 → クリックで個々の board を表示
   */
  public function index()
  {
    return response()->json('成功！');
  }

  /**
   * 新規ボードの生成 → 保存
   *
   * ホーム画面でテンプレートを選択し、propsとして情報を渡す
   * create 画面で props をもとに該当のテンプレートを表示＆新規保存
   */
  public function create(Request $request)
  {
    $board = Board::create([
      'user_id' => $request['user_id'],
      "edited_html" => ""
    ]);

    return response()->json($board->id);
  }

  /**
   * 編集画面の表示
   */
  public function edit(string $id)
  {
    $message = "edit:通信成功！";
    $board = Board::find($id);
    $edited_html = $board->edited_html;
    return response()->json([$message, $edited_html]);
  }

  /**
   * ボードの更新
   */
  public function update(Request $request, string $id)
  {
    $message = "update:成功！";

    $board = Board::find($id);
    if ($board === null) {
      $res = response()->json(
        [
          'errors' => '投稿が見つかりませんでした',
        ],
        404
      );
      throw new HttpResponseException($res);
    }
    $edited_html = $board->edited_html;

    $board->edited_html = $request->edited_html;
    $board->save();


    return response()->json([$edited_html]);
  }

  /**
   * ボードの削除
   */
  public function destroy(string $id)
  {
    //
  }
}
