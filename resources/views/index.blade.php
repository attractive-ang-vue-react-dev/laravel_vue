@extends('layout')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="links">
                <a href="{{ route('products.index') }}">Products | </a>
                <a href="{{ route('categories.index') }}">Categories</a>
            </div>
        </div>
    </div>
@endsection
