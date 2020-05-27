<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $posts_query = Post::query();
        
        if($request->search) {
            $posts_query = $posts_query->where('title', 'LIKE', "%{$request->search}%");
        }

        if($request->category) {
            $posts_query = $posts_query->where('category_id', $request->category);
        }

        if($request->tag) {
            $posts_query = $posts_query->whereHas('tags', function($query) use ($request) {
                $query->where('tags.id', '=', $request->tag);
            });
        }

        if ($request->author) {
            $posts_query = $posts_query->where('user_id', $request->author);
        }

        return view('blog.index')
            ->with('categories', Category::all())
            ->with('tags', Tag::all())
            ->with('posts', $posts_query->simplePaginate(env("POST_PER_PAGE")));
    }

    public function show(Post $post)
    {
        return view('blog.show')->with('post', $post);

    }
}
