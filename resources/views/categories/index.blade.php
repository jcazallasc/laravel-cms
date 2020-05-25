@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">{{ __('Categories') }}</div>

    <div class="card-body">
        <ul class="list-group">
            @foreach($categories as $category)
                <li class="list-group-item">
                    {{ $category->name }}
                    <button type="button" class="btn btn-danger btn-sm float-right mr-1" data-toggle="modal" data-target="#deleteModal" onclick="handleDelete('{{ route('categories.destroy', $category->id) }}')">
                        {{ __('Delete') }}
                    </button>
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-success btn-sm float-right mr-1">
                        {{ __('Edit') }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
<a href="{{ route('categories.create') }}" class="btn btn-success btn-block float-right my-2">
    {{ __('Add category') }}
</a>

@include('categories.modals.delete')
@endsection

@section('scripts')
<script>
    function handleDelete(action) {
        $('#deleteModal form').attr('action', action);
    }
</script>
@endsection

