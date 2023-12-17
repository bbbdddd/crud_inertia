<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use \Illuminate\Http\RedirectResponse;
use \Inertia\Response;
use \Inertia\ResponseFactory;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $posts = PostResource::collection($posts)->resolve();
        return inertia('Post/Index', compact('posts'));
    }

    public function show(Post $post)
    {
        return inertia('Post/Show', compact('post'));
    }


    public function create()
    {
        return inertia('Post/Create');
    }

    public function store(StoreRequest $request)
    {
        Post::create($request->validated());
        return redirect()->route('post.index');
    }

    public function edit(Post $post)
    {
        return inertia('Post/Edit', compact('post'));
    }

    public function update(Post $post, UpdateRequest $request)
    {
        $post->update($request->validated());
        return redirect()->route('post.index');
    }

    public function delete(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }
}
