<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Reply;

class CommentController extends Controller
{
    //
    public function add(Request $request)
    {
        $user = $request->user();
        Post::find($request->post_id)->comments()->create(['post_id' => $request->post_id, 'user_id' => $user->id, 'text' => $request->text]);
    }

    public function list(Request $request, $post_id)
    {
        $comments = Comment::where('post_id', $post_id)->with(['user', 'replies.user'])->get();
        return response()->json($comments);
    }

    public function reply(Request $request, $comment_id)
    {
        $user_id = $request->user()->id;
        Reply::create(['comment_id' => $comment_id, 'user_id' => $user_id, 'text' => $request->text]);
    }
}
