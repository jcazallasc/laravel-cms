@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">{{ __('Posts') }}</div>

    <div class="card-body">
        @if($posts->count() > 0)
            <table class="table">
                <thead>
                    <th>{{ __('Image') }}</th>
                    <th>{{ __('Title') }}</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td><img src="{{ asset('storage/' . $post->image) }}" width="120px" alt="{{ $post->title }}"></td>
                            <td>{{ $post->title }}</td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm float-right mr-1" data-toggle="modal" data-target="#deleteModal" onclick="handleDelete('{{ route('posts.destroy', $post->id) }}')">
                                    {{ $post->trashed() ? __('Delete'):__('Trash') }}
                                </button>
                                @if(!$post->trashed())
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary btn-sm float-right mr-1">
                                        {{ __('Edit') }}
                                    </a>
                                @else
                                    <form action="{{ route('posts.restore', $post->id) }}" method="POST">
                                        @method('put')
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm float-right mr-1">{{ __('Restore') }}</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>   
        @else
            <h3 class="text-center">{{ __('No Posts Yet') }}</h3>
        @endif
    </div>
</div>
@if(Route::currentRouteName() != 'posts.trash')
    <a href="{{ route('posts.create') }}" class="btn btn-success btn-block float-right my-2">
        {{ __('Add post') }}
    </a>
@endif

@include('posts.modals.delete')
@endsection

@section('scripts')
<script>
    function handleDelete(action) {
        $('#deleteModal form').attr('action', action);
    }
</script>
@endsection

