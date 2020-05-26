<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Tags\StoreTagRequest;
use App\Http\Requests\Tags\UpdateTagRequest;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('tags.index')->with('tags', Tag::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StoreTagRequest $request)
    {
        $tag = new Tag();
        $tag->fill($request->only('name'));
        $tag->save();

        Session::flash('success', 'Tag created successfully!');
        return Redirect::to(route('tags.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Tag $tag)
    {
        return view('tags.create')->with('tag', $tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->update($request->only('name'));
        $tag->save();

        Session::flash('success', 'Tag updated successfully!');
        return Redirect::to(route('tags.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        Session::flash('success', 'Tag deleted successfully!');
        return Redirect::to(route('tags.index'));
    }
}
