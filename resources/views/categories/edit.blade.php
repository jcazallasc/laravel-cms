@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update category') }}</div>

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
                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name', $category->name) }}" />
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success">{{ __('Update category') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
