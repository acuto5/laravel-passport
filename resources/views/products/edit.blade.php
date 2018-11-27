@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Update product') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('product.update', $product->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="title">{{ __('Title') }}</label>
                                <input type="text" name="title" id="title" value="{{ old('title', $product->title) }}" class="form-control">
                                @if($errors->has('title'))
                                    <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="price">{{ __('Price') }}</label>
                                <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" class="form-control" step="0.01">
                                @if($errors->has('price'))
                                    <div class="alert alert-danger">{{ $errors->first('price') }}</div>
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