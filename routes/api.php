<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\VisionController;
use App\Http\Controllers\TextController;

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//   return $request->user();
// });

Route::get('/test', [TestController::class, 'index']);

Route::prefix('vision_boards')
  ->name('vision_boards.')
  ->controller(VisionController::class)
  ->group(function () {
    Route::get('/', 'index')->name('index');
    // Route::get('/{id}', 'get')->name('get');
    Route::post('/', 'create')->name('create');
    // Route::post('/', 'store')->name('store');
    Route::get('/{id}', 'edit')->name('edit');
    Route::put('/{id}', 'update')->name('update');
    Route::delete('/{id}', 'destroy')->name('destroy');
  });

Route::prefix('texts')
  ->name('texts.')
  ->controller(TextController::class)
  ->group(function () {
    // Route::get('/', 'index')->name('index');
    // ボード新規作成時に６個同時に作成してボードと紐付ける
    Route::post('/', 'create')->name('create');
    // Route::post('/', 'store')->name('store');
    // ボードのedit ルートと同時に、該当ボードのテキスト取得
    Route::get('/{id}', 'edit')->name('edit');
    // 随時更新
    Route::put('/{id}', 'update')->name('update');
    // ボード削除時に同時削除
    Route::delete('/{id}', 'destroy')->name('destroy');
  });
