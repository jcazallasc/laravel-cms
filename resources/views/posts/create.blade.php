@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
        {{ isset($post) ? __('Edit post'):__('Create post') }}
    </div>

    <div class="card-body">
        @include('shared.errors')
        <form enctype="multipart/form-data" action="{{ isset($post) ? route('posts.update', $post->id):route('posts.store') }}" method="POST">
            @csrf
            @if (isset($post))
                @method('put')
            @endif
            <div class="form-group">
                <label for="title">{{ __('Title') }}</label>
                <input type="text" id="title" class="form-control" name="title" placeholder="Title" value="{{ isset($post) ? old('title', $post->title):old('title')  }}" />
            </div>
            <div class="form-group">
                <label for="description">{{ __('Description') }}</label>
                <textarea name="description" class="form-control" id="description" placeholder="{{ __('Description') }}" cols="5" rows="5">{{ isset($post) ? old('description', $post->description):old('description')  }}</textarea>
            </div>
            <div class="form-group">
                <label for="content">{{ __('Content') }}</label>
                <textarea name="content" class="form-control" id="content" placeholder="{{ __('Content') }}" cols="5" rows="5">{{ isset($post) ? old('content', $post->content):old('content')  }}</textarea>
            </div>
            <div class="form-group">
                <label for="published_at">{{ __('Published at') }}</label>
                <input type="text" id="published_at" class="form-control" name="published_at" placeholder="{{ __('Published at') }}" value="{{ isset($post) ? old('published_at', $post->published_at):old('published_at')  }}" />
            </div>
            <div class="form-group">
                <label for="image">{{ __('Image') }}</label>
                <input type="file" id="image" class="form-control" name="image" />
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">{{ isset($post) ? __('Update post'):__('Add post') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
