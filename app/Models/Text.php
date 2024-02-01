<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
  use HasFactory;

  public function board()
  {
    return $this->belongsTo(Board::class);
  }

  protected $fillable = [
    'id',
    'area',
    'text',
    'board_id'
  ];
}
