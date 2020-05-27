<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\Category;
use App\User;

class BlogController extends Controller
{
    public function index()
    {
        return view('blog.index')
            ->with('categories', Category::all())
            ->with('tags', Tag::all())
            ->with('posts', Post::searched()->simplePaginate(env("POST_PER_PAGE")));
    }    

    public function post(Post $post)
    {
        return view('blog.post')->with('post', $post);

    }

    public function category(Category $category)
    {
        return view('blog.index')
            ->with('categories', Category::all())
            ->with('tags', Tag::all())
            ->with('posts', $category->posts()->searched()->simplePaginate(env("POST_PER_PAGE")));
    }

    public function tag(Tag $tag)
    {
        return view('blog.index')
            ->with('categories', Category::all())
            ->with('tags', Tag::all())
            ->with('posts', $tag->posts()->searched()->simplePaginate(env("POST_PER_PAGE")));
    }

    public function author(User $user)
    {
        return view('blog.index')
            ->with('categories', Category::all())
            ->with('tags', Tag::all())
            ->with('posts', $user->posts()->searched()->simplePaginate(env("POST_PER_PAGE")));
    }        
}
