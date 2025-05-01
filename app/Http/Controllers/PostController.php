<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    //
    public function create(Request $request)
    {
        $user = $request->user();
        $post = new Post();
        $post->text = $request->input('text');
        $post->user_id = $user->id;
        $post->save();
    }
}
