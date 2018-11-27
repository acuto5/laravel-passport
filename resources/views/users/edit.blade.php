@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Update user') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('user.update', $user->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-control">
                                @if($errors->has('name'))
                                    <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input type="text" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control">
                                @if($errors->has('email'))
                                    <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>{{ __('Roles') }}</label><br>
                                @foreach($roles as $role)
                                    <div class="form-check">
                                        <input type="checkbox" name="roles[]" id="role_{{ $role->id }}" value="{{ $role->id }}" {{ (in_array($role->id, $user->roles->pluck('id')->toArray()))? 'checked' : ''}}>
                                        <label class="form-check-label" for="role_{{ $role->id }}">{{ $role->title }}</label>
                                    </div>
                                @endforeach
                                @if($errors->has('email'))
                                    <div class="alert alert-danger">{{ $errors->first('email') }}</div>
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