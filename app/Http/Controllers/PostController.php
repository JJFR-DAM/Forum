<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Rules\ValidReply;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $post_request)
    {
        Post::create($post_request->input());
        // Esto coge todos los datos que vienen vía Post y los inserta
        return back()->with('message', ['success', __('Post creado correctamente')]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $replies = $post->replies()->with(['owner'])->paginate(2);
        return view('posts.detail', compact('replies', 'post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post, PostRequest $post_request)
    {
        $this->validate(request(), [
            'title' => ['required', new ValidReply],
            'description' => ['required', new ValidReply],
        ]);
        $post->update($post_request->input());
        return back()->with('message', ['success', __('Post editado correctamente')]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (!$post->isOwner()) {
            abort(401);
        }
        $post->delete();
        return back()->with('message', ['success', __('Post y respuestas eliminados correctamente')]);
    }
}