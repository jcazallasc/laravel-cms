@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">{{ __('Dashboard') }}</div>

    <div class="card-body">
        @auth
            {{ __('You are logged in!') }}
        @else
            {{ __('You AREN\'T logged in!') }}  
        @endauth
    </div>
</div>
@endsection
