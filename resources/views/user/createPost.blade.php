@extends('layouts.app')

@section('content')
    <div>
        <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="image">Select an image</label>
            <input name="image" type="file" value="{{ old('image') }}"/>
            @error('image')
                <p class="text-danger">{{ $errors->first('image') }}</p>
            @enderror
            <label for="description">Description</label>
            <input
                type="text"
                name="description"
                id="description"
                value="{{ old('description') }}">
            @error('description')
            <p class="text-danger">{{ $errors->first('description') }}</p>
            @enderror

            <input type="submit" value="Save">
        </form>
    </div>
@endsection
