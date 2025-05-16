<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;

class LikeController extends Controller
{
    //
    public function add(Request $request)
    {
        $user = $request->user();
        $post = Post::find($request->input('post_id'));
        Gate::authorize('like', $post);
        $post->likes()->create(["user_id"=>$user->id]);
    }

    public function remove(Request $request)
    {
        $user = $request->user();
        $post = Post::find($request->input('post_id'));
        $post->likes()->where(["user_id"=>$user->id])->delete();
    }

    public function list(Request $request, $post_id)
    {
        $user = $request->user();
        $post = Post::find($post_id);
        $likes = $post->likes()->with('user')->get();
        return response()->json($likes);
    }
}
