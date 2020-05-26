@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">{{ __('Users') }}</div>

    <div class="card-body">
        @if($users->count() > 0)
            <table class="table">
                <thead>
                    <th>{{ __('Image') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td><img src="{{ asset('storage/' . '') }}" width="120px" alt="{{ $user->name }}"></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if(!$user->isAdmin())
                                    <button class="btn btn-success btn-sm">{{ __('Make admin') }}</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>   
        @else
            <h3 class="text-center">{{ __('No Users Yet') }}</h3>
        @endif
    </div>
</div>
@endsection

