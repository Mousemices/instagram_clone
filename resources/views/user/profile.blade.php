@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="m-2">
                    <button class="btn border-info">
                        <a href="{{route('post.create')}}">Create Post</a>
                    </button>
                </div>
                <div class="card-header font-weight-bolder">
                    <i class="fas fa-user pr-2"></i>Profile</div>
                @auth
                    <p class="pl-3 pt-2 font-weight-bold">{{Auth::user()->name}}</p>
                    <p class="pl-3 pt-2 font-weight-bold">{{Auth::user()->email}}</p>
                @endauth
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div id="user_post">
                    <i class="fas fa-table post_title pr-2 border-bottom"></i><span>Posts</span>
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
                        <p class="pt-2 pl-3 text-uppercase">----------Currently 0 post-----------</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
