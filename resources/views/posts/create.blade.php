@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
        {{ isset($post) ? __('Edit post'):__('Create post') }}
    </div>

    <div class="card-body">
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
                <input type="hidden" id="content" name="content" value="{{ isset($post) ? old('content', $post->content):old('content') }}">
                <trix-editor input="content"></trix-editor>
            </div>
            <div class="form-group">
                <label for="published_at">{{ __('Published at') }}</label>
                <input type="text" id="published_at" class="form-control" name="published_at" value="{{ isset($post) ? old('published_at', $post->published_at):old('published_at')  }}" />
            </div>
            <div class="form-group">
                <label for="image">{{ __('Image') }}</label>
                <input type="file" id="image" class="form-control" name="image" />
            </div>
            @if(isset($post))
                <div class="form-group text-center">
                    <img src="{{ asset('storage/' . $post->image) }}" width="120px" alt="{{ $post->title }}">
                </div>
            @endif
            <div class="form-group">
                <label for="category_id">{{ __('Category') }}</label>
                <select name="category_id" id="category_id" class="form-control">
                    @foreach($categories as $category)
                        <option {{ isset($post) && $post->category_id == $category->id ? 'selected':'' }} value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            @if ($tags->count() > 0)
                <div class="form-group">
                    <label for="tags">{{ __('Tags') }}</label>
                    <select name="tags[]" id="tags" class="form-control" multiple>
                        @foreach($tags as $tag)
                            <option {{ isset($post) && $post->hasTag($tag->id) ? 'selected':'' }} value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            <div class="form-group">
                <button type="submit" class="btn btn-success">{{ isset($post) ? __('Update post'):__('Add post') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    flatpickr('#published_at', {
       enableTime: true, 
       enableSeconds: true,
    });

    $(document).ready(function() {
        $('#tags').select2();
    });
</script>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" />
@endsection
