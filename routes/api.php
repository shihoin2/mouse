<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\VisionController;
use App\Http\Controllers\FeedTemplateController;

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//   return $request->user();
// });

Route::get('/test', [TestController::class, 'index']);

Route::prefix('vision_boards')
  ->name('vision_boards.')
  ->controller(VisionController::class)
  ->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'create')->name('create');
    Route::post('/{board_id}', 'imageStore')->name('imageStore');
    Route::patch('/capture/{board_id}', 'thumbnailPatch')->name('thumbnailPatch');
    Route::get('/{id}', 'edit')->name('edit');
    Route::put('/{id}', 'update')->name('update');
    Route::delete('/{id}', 'destroy')->name('destroy');
  });

Route::get('/feedTemplate', [FeedTemplateController::class, 'feedTemplates']);