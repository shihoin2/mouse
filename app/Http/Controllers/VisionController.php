<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Text;
use App\Models\Image;
use Illuminate\Http\Exceptions\HttpResponseException;
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
    $response = [
      "message" => "indexルート",
    ];
    return response()->json($response);
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
        'text' => "",
        "board_id" => $board->id
      ]);
      $textBoxes[] = [$area => $data->text];
    }

    $response = [
      "message" => "createルート",
      "board_id" => $board->id,
      "textBoxes" => $textBoxes
    ];

    return response()->json($response);
  }

  /**
   * 編集画面の表示
   */
  public function edit(string $id)
  {
    $board = Board::find($id);
    $texts_data = Text::where('board_id', $id)->get();

    $textBoxes = [];
    if ($texts_data) {
      foreach ($texts_data as $text_data) {
        $textBoxes[$text_data->area] = $text_data->text;
      }
    } else {
      $textBoxes = "空でした";
    }

    $response = [
      "message" => "editルート",
      "edited_html" => $board->edited_html,
      "textBoxes" => $textBoxes,
    ];
    return response()->json($response);
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
   * ボードの更新
   */
  public function update(Request $request, string $id)
  {
    $board = Board::find($id);
    $texts_data = Text::where(['board_id' => $id])->get();

    if ($board === null) {
      $res = response()->json(
        [
          'errors' => '投稿が見つかりませんでした',
        ],
        404
      );
      throw new HttpResponseException($res);
    }

    $board->edited_html = $request->edited_html;
    $board->save();

    $textBoxes = [];
    foreach ($texts_data as $text_data) {
      if ($request->textBoxes[$text_data->area]) {
        $text_data->text = $request->textBoxes[$text_data->area];
      } else {
        $text_data->text = "";
      }
      $text_data->save();
      $textBoxes[$text_data->area] = $text_data->text;
    }
    // $texts_data->save()


    $response = [
      "message" => "updateルート",
      "edited_html" => $board->edited_html,
      "textBoxes" => $textBoxes
    ];

    return response()->json($response);
  }

  /**
   * ボードの削除
   */
  public function destroy(string $id)
  {
    //
  }
}
