<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;

class FeedMyBoardController extends Controller
{
    public function feedMyBoards(Request $request)
    {
        // ユーザー固定
        return Board::select('id', 'board_thumbnail')->where('user_id', '=', 1)->paginate(4);
    }
}