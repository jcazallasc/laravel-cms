@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Categories') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul class="list-group">
                        @foreach($categories as $category)
                            <li class="list-group-item">
                                {{ $category->name }}
                                <a href="{{ route('categories.show', $category->id) }}" class="btn btn-primary btn-sm float-right mr-1">
                                    {{ __('View') }}
                                </a>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-success btn-sm float-right mr-1">
                                    {{ __('Edit') }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
