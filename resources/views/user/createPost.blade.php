@extends('layouts.app')

@section('content')
    <div class="mt-5" id="post_form_create">
        <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data" class="post_form_store">
            @csrf
            <label for="image">Select an image</label>
            <input name="image" type="file" id="image" value="{{ old('image') }}"/>
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

            <input type="submit" value="Save" class="button">
        </form>
    </div>
@endsection
