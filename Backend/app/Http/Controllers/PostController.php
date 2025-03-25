<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use http\Message;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return Post::all();
    }

    public function getOnePost($id)
    {
        return Post::findOrFail($id);
    }

    public function store(CreatePostRequest $request)
    {
        //$user = $request->user();
        //$category = $request->category();

        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->price = $request->price;
        $post->is_repair = $request->is_repair;
        $post->is_complete = false;
        $post->category_id = $request->category()->id;
        $post->user_id = $request->user()->id;

        $post->save();

        return response()->json($post, 200);
    }

    public function update($id, UpdatePostRequest $request)
    {
        $post = Post::findOrFail($id);
        $post->fill($request->validated());
        $post->save();
        return response()->json($post, 200);
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json(['message' => 'Post has been deleted / removed from the database successfully',
                'post' => $post
        ]);
    }

    public function getCategoryPosts($cat_id)
    {
        return Post::where('category_id', $cat_id)->get();
    }
}
