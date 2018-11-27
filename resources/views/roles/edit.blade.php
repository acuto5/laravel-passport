@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Update role') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('role.update', $role->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="title">{{ __('Title') }}</label>
                                <input type="text" name="title" id="title" value="{{ old('title', $role->title) }}" class="form-control">
                                @if($errors->has('title'))
                                    <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="discount">{{ __('Discount') }}</label>
                                <input type="number" name="discount" id="discount" value="{{ old('discount', $role->discount) }}" class="form-control">
                                @if($errors->has('discount'))
                                    <div class="alert alert-danger">{{ $errors->first('discount') }}</div>
                                @endif
                            </div>

                            <input type="submit" class="btn btn-sm btn-success" value="{{ __('Save') }}">
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection