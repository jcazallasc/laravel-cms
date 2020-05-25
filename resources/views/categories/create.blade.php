@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">{{ __('Create category') }}</div>

    <div class="card-body">
        @if($errors->any())
            <div class="div alert alert-danger">
                <ul class="li list-group">
                    @foreach($errors->all() as $error)
                        <li class="list-group-item">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <input type="text" id="name" class="form-control" name="name" placeholder="Name" value="{{ old('name') }}" />
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">{{ __('Add category') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
