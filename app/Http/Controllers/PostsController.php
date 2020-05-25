<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Posts\StorePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->only([
            'title',
            'description',
            'content',
            'published_at',
        ]);

        $image = $request->image->store('posts');
        $data['image'] = $image;

        $post = new Post();
        $post->fill($data);
        $post->save();

        Session::flash('status', 'Post created successfully!');
        return Redirect::to(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.create')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->only([
            'title',
            'description',
            'content',
            'published_at',
        ]);

        if($request->hasFile('image')) {
            $image = $request->image->store('posts');
            $post->deleteImage();
            $data['image'] = $image;
        }

        $post->update($data);
        $post->save();

        Session::flash('status', 'Post updated successfully!');
        return Redirect::to(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $postId
     * @return \Illuminate\Http\Response
     */
    public function destroy($postId)
    {
        $post = Post::withTrashed()->where('id', $postId)->firstOrFail();

        if($post->trashed()) {
            $post->forceDelete();
            $post->deleteImage();
        } else {
            $post->delete();
        }

        Session::flash('status', 'Post deleted successfully!');
        return Redirect::to(route('posts.index'));
    }

    /**
     * Display a list of all trashed posts
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        return view('posts.index')->withPosts(Post::onlyTrashed()->get());
    }

    /**
     * Restore a trashed post
     *
     * @param  int  $postId
     * @return \Illuminate\Http\Response
     */
    public function restore($postId)
    {
        $post = Post::onlyTrashed()->where('id', $postId)->firstOrFail();
        $post->restore();

        Session::flash('status', 'Post restored successfully!');
        return view('posts.index')->withPosts(Post::all());
    }    
}
