@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
        {{ isset($category) ? __('Edit category'):__('Create category') }}
    </div>

    <div class="card-body">
        <form action="{{ isset($category) ? route('categories.update', $category->id):route('categories.store') }}" method="POST">
            @csrf
            @if (isset($category))
                @method('put')
            @endif
            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <input type="text" id="name" class="form-control" name="name" placeholder="Name" value="{{ isset($category) ? old('name', $category->name):old('name')  }}" />
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">{{ isset($category) ? __('Update category'):__('Add category') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
