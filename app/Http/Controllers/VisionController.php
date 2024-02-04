<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Text;
use App\Models\Image;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


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
      "edited_html" => "",
      'tpl_id' => 1
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
  public function imageStore(Request $request, $board_id)
  {
    //id受け渡しのとき
    if ($request->hasFile('image')) {
      $file_name = $request->file('image')->getClientOriginalName();
      $file_path = $request->file('image')->storeAs('public', $file_name);


      $image = new Image();
      $image->image_name = $file_name;
      $image->image_path = $file_path;
      $image->board_id = $board_id;

      $image->save();

      $image = Image::latest()->first();
      // $imagePath = $image->image_path;
      $imagePath = Storage::url($file_path);
      // $imageUrl = asset('storage/' . $imagePath);
      $imageUrl = asset('storage/' . $file_name);
      return response()->json(['image_url' => $imageUrl]);
    } else {
    }
  }
  /**
   * 画像の保存
   * board_idを取得して保存
   */
  // public function thumbnailStore(Request $request)
  public function thumbnailPatch(Request $request, $board_id)
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
      Board::where('id', $board_id)->update([
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
    Log::debug($request);
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
