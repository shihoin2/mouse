<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Text;

use function Laravel\Prompts\text;

class TextController extends Controller
{
  /**
   * ボード新規作成時に６個同時に作成してボードと紐付ける
   */
  public function create(Request $request)
  {
    $areas = [
      "lifeStyle",
      "work",
      "name_year",
      "will",
      "fun",
      "health"
    ];

    $textBoxes = [];
    foreach ($areas as $area) {
      $data = Text::create([
        'area' => $area,
        "board_id" => $request['user_id']
      ]);
      $textBoxes[] = [$area => $data->text];
    }

    $response = [
      "message" => "texts.createルート",
      "textBoxes" => $textBoxes
    ];
    return response()->json($response);
  }

  /**
   * ボードのedit ルートと同時に、該当ボードのテキスト取得
   */
  public function edit(string $id)
  {
    $board = Text::find($id);

    $response = [
      "message" => "editルート",
      "edited_html" => $board->edited_html
    ];
    return response()->json($response);
  }

  /**
   * 随時更新
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * ボード削除時に同時削除
   */
  public function destroy(string $id)
  {
    //
  }
}
