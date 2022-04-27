<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Support\Facades\File;


class PostController extends Controller
{
    public function create_page()
    {
        return view('posts.create');
    }

    public function create(Request $request)
    {
        $user = Auth::user();

        $post = new Post;
        $post->user_id = $user->id;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();

        $post_id = $post->id;

        $files = $request->file('file');
        $filename = $files->getClientOriginalName();
        $upload = File::put(public_path('image/'. $filename), File::get($files));
        $path = url('image/'. $filename);

            $post_image = new PostImage;
            $post_image->post_id = $post_id;
            $post_image->image_path = $path;
            $post_image->save();

        return response()->json([
            'success' => true,
            'message' => 'Post created successfully!',
        ]);
    }
}
