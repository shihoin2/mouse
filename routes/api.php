<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\VisionController;

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
    // Route::get('/{image_id}', 'getImage')->name('getImage');
    Route::get('/{id}', 'edit')->name('edit');
    Route::put('/{id}', 'update')->name('update');
    Route::delete('/{id}', 'destroy')->name('destroy');
  });
