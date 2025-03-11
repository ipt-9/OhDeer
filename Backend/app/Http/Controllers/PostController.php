<?php

namespace App\Http\Controllers;

use App\Models\Post;
use http\Message;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return Post::all();
    }
}
