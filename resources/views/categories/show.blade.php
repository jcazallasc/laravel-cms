@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">{{ __('Details') }}</div>

    <div class="card-body">
        {{ $category->name }}
    </div>
</div>
<div class="form-group">
    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-full mt-3 float-right">{{ __('Edit') }}</a>
</div>

<form action="{{ route('categories.destroy', $category->id) }}" method="post">
    @csrf
    @method('delete')
    <button type="submit" class="btn btn-danger float-left">
        {{ __('Delete') }}
    </button>
</form>
@endsection
