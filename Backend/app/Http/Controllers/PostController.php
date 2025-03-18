<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use http\Message;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return Post::all();
    }

    public function GetOnePost($id)
    {
        return Post::findOrFail($id);
    }

    public function store(CreatePostRequest $request)
    {
        $user = $request->user();

        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->price = $request->price;
        $post->is_repair = $request->is_repair;
        $post->is_complete = false;
        $post->category_id = $request->category()->id;
        $post->customer_id = $request->customer()->id;

        $post->save();

        return $post;
    }

    public function update($id, UpdatePostRequest $request)
    {
        $post =Post::findOrFail($id);
        $post->fill($request->validated());
        $post->save();

        return $post;
    }


}
