@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">{{ __('Categories') }}</div>

    <div class="card-body">
        @if($categories->count() > 0)
            <ul class="list-group">
                @foreach($categories as $category)
                    <li class="list-group-item">
                        {{ $category->name }}
                        <span class="badge badge-secondary ml-2">{{ $category->posts->count() }}</span>
                        <button type="button" class="btn btn-danger btn-sm float-right mr-1" data-toggle="modal" data-target="#deleteModal" onclick="handleDelete('{{ route('categories.destroy', $category->id) }}', '{{ __('Delete category') }}')">
                            {{ __('Delete') }}
                        </button>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-sm float-right mr-1">
                            {{ __('Edit') }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <h3 class="text-center">{{ __('No Categories Yet') }}</h3>
        @endif
    </div>
</div>
<a href="{{ route('categories.create') }}" class="btn btn-success btn-block float-right my-2">
    {{ __('Add category') }}
</a>

@include('shared.modals.delete')
@endsection

