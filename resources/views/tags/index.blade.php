@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">{{ __('Tags') }}</div>

    <div class="card-body">
        @if($tags->count() > 0)
            <ul class="list-group">
                @foreach($tags as $tag)
                    <li class="list-group-item">
                        {{ $tag->name }}
                        <button type="button" class="btn btn-danger btn-sm float-right mr-1" data-toggle="modal" data-target="#deleteModal" onclick="handleDelete('{{ route('tags.destroy', $tag->id) }}')">
                            {{ __('Delete') }}
                        </button>
                        <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-primary btn-sm float-right mr-1">
                            {{ __('Edit') }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <h3 class="text-center">{{ __('No Tags Yet') }}</h3>
        @endif
    </div>
</div>
<a href="{{ route('tags.create') }}" class="btn btn-success btn-block float-right my-2">
    {{ __('Add tag') }}
</a>

@include('tags.modals.delete')
@endsection

@section('scripts')
<script>
    function handleDelete(action) {
        $('#deleteModal form').attr('action', action);
    }
</script>
@endsection

