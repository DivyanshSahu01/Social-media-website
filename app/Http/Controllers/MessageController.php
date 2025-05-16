<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    //
    public function list(Request $request, $user_id)
    {
        $user = $request->user();
        $dates = Message::whereRaw("(from_id = $user_id AND to_id = $user->id) OR (to_id = $user_id AND from_id = $user->id)")->get()->groupBy(function($msg) {
            return $msg->created_at->format('d/m/Y');
        });
        return response()->json($dates);
    }

    public function send(Request $request)
    {
        $user = $request->user();
        Message::create(['text' => $request->input('text'), 'from_id' => $user->id, 'to_id' => $request->input('user_id')]);
    }
}
