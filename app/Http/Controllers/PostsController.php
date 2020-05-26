<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Posts\StorePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('verifyCategoriesCount')->only([
            'create',
            'store',
        ]);
    }
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
        return view('posts.create')
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
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
            'category_id',
            'published_at',
        ]);

        $image = $request->image->store('posts');
        $data['image'] = $image;
        $post = Post::create($data);

        if($request->has('tags')) {
            $post->tags()->attach($request->tags);
        }

        Session::flash('success', 'Post created successfully!');
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
        return view('posts.create')
            ->with('post', $post)
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
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
            'category_id',
            'published_at',
        ]);

        if($request->hasFile('image')) {
            $image = $request->image->store('posts');
            $post->deleteImage();
            $data['image'] = $image;
        }

        $post->update($data);
        $post->save();

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        Session::flash('success', 'Post updated successfully!');
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

        Session::flash('success', 'Post deleted successfully!');
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

        Session::flash('success', 'Post restored successfully!');
        return Redirect::to(route('posts.trash'));
    }    
}
