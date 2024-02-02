<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;

class FeedMyBoardController extends Controller
{
    public function feedMyBoards(Request $request)
    {
        // return Board::where('user_id', '=', `$request->id`)->paginate(4);
        return Board::where('user_id', '=', `1`)->paginate(4);
    }
}
