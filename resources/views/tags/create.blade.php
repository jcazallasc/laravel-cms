@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
        {{ isset($tag) ? __('Edit tag'):__('Create tag') }}
    </div>

    <div class="card-body">
        <form action="{{ isset($tag) ? route('tags.update', $tag->id):route('tags.store') }}" method="POST">
            @csrf
            @if (isset($tag))
                @method('put')
            @endif
            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <input type="text" id="name" class="form-control" name="name" placeholder="Name" value="{{ isset($tag) ? old('name', $tag->name):old('name')  }}" />
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">{{ isset($tag) ? __('Update tag'):__('Add tag') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
