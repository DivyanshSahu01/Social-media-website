<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    //
    public function create(Request $request)
    {
        $request->validate([
            'text'=>'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user = $request->user();
        $post = new Post();
        $post->text = $request->input('text');
        $post->user_id = $user->id;

        if($request->hasFile('image')) 
        {
            $image = $request->file('image');
            $path = $image->store('posts', 'public');
            $post->image = "storage/".$path;
        }

        $post->save();

        return response()->json(['message'=>'Post created successfully'], 200);
    }

    public function list(Request $request)
    {
        $user = $request->user();
        $posts = Post::with(['user', 'likes.user', 'comments.user', 'comments.replies.user'])->latest()->paginate(5);

        foreach($posts as $post)
        {
            $post->is_liked = $post->likedBy($user->id);
        }

        return response()->json($posts);
    }

    public function delete(Request $request, $post_id)
    {
        $post = Post::find($post_id);
        Gate::authorize('delete', $post);
        if(file_exists($post->image))
        {
            unlink($post->image);
        }
        $post->delete();

        return response()->json(['message'=>'Post deleted successfully'], 200);
    }
}
