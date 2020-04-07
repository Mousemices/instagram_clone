@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="m-2">
                    <button class="btn">
                        <a href="{{route('post.create')}}">Create Post</a>
                    </button>
                </div>
                <div class="card-header">Profile</div>
                @auth
                    <p class="p-2">{{Auth::user()->name}}</p>
                    <p class="p-2">{{Auth::user()->email}}</p>
                @endauth
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div id="user_post">
                    <i class="fas fa-table post_title"></i><span> Posts</span>
                </div>

                <div class="single_post">
                    @forelse($userPosts as $post)
                            {{--<p>{{ $post->description }}</p>--}}
                        <div class="delete_post">

                            <form action="{{ route('post_delete', $post )}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    <i class="far fa-trash-alt delete_button"></i>
                                </button>
                            </form>

                            <div class="post_img">
                                <img src="{{ url('storage/posts/'.$post->image) }}" alt="">
                            </div>
                        </div>

                    @empty
                        <p>Currently 0 post</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
