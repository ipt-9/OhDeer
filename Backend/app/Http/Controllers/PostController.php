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
        return Post::orderBy('created_at', 'desc')->get();
    }

    public function getOnePost($id)
    {
        return Post::with('category', 'user')->where('id', $id)->first();
    }

    public function store(CreatePostRequest $request)
    {
        $request->validated();

        $user = $request->user();
        $category = Category::findOrFail($request->category_id);

        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->price = $request->price;
        $post->is_repair = $request->is_repair;
        $post->is_complete = false;
        $post->category_id = $category->id;
        $post->user_id = $user->id;

        $post->save();

        return response()->json(['message' => 'Post has been added to the database.',
            'post' => $post
        ]);
    }

    public function update($id, UpdatePostRequest $request)
    {
        $post = Post::findOrFail($id);

        if ($request->user()->id !== $post->user_id) {
            abort(403);
        }
        $post->fill($request->validated());
        $post->save();
        return response()->json(['message' => 'Post has been edited successfully',
            'post' => $post
        ]);
    }

    public function delete($id, Request $request)
    {
        $post = Post::findOrFail($id);

        if ($request->user()->id !== $post->user_id) {
            abort(403);
        }

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
