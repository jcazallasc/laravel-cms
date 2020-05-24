@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Details') }}</div>

                <div class="card-body">
                    {{ $category->name }}
                </div>
            </div>
            <div class="form-group">
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info btn-full mt-3 btn-block">{{ __('Edit') }}</a>
            </div>
            
            <form action="{{ route('categories.delete', $category->id) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger btn-block">
                    {{ __('Delete') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
