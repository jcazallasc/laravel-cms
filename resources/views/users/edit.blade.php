@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">{{ __('My profile') }}</div>

    <div class="card-body">
        <form action="{{ route('users.update-profile')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <input name="name" id="name" class="form-control" value="{{ $user->name }}"/>
            </div>
            <div class="form-group">
                <label for="about">{{ __('About') }}</label>
                <textarea name="about" id="about" class="form-control" cols="5" rows="5">{{ $user->about }}</textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">{{ __('Update profile') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
