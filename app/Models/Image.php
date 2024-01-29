<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public function board()
    {
        return $this->belongsTo(Board::class);
    }

    protected $fillable = [
        'id',
        'image_name',
        'image_path',
        'board_id'
    ];
}
