@extends('layouts.app')

@section('content')
    <div id="content">
        <div class="posts">
            @forelse($posts as $post)
                <div class="post">
                    <div class="post_title">
                        <div class="post_owner">
                            <p><strong>{{$post->user->name}}</strong></p>
                        </div>
                        <div class="delete_post_form">
                            @auth
                                @can('delete', $post)
                                    <form action="{{ route('post_delete', $post )}}" method="post" class="post_form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <i class="far fa-trash-alt delete_post_button"></i>
                                        </button>
                                    </form>
                                @endcan
                            @endauth
                        </div>

                    </div>

                    <div class="post_img">
                        <img src="{{ url('storage/posts/'.$post->image) }}" alt="">
                    </div>
                    <div class="post_description">
                        <p class="date">{{$post->created_at}}</p>
                        <p class="author"><span class="post_author">{{$post->user->name}}: </span>{{ $post->description }}</p>
                    </div>
                    <div class="comments">
                        @forelse($post->comments as $comment)
                            <div class="user_who_comment">
                                @if(strpos($comment, $tagName))
                                    <div class="user_comment1">
                                        @auth
                                            @can('adminOrOwner', $comment)
                                                <form action="{{ route('comment.delete', $comment) }}" method="post" class="delete_comment_form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit">
                                                        <i class="fas fa-times remove_comment"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        @endauth
                                            <span class="user_comment">{{$comment->user->name}} </span> : <span>{{ $comment->description }}</span>
                                    </div>
                                    <div class="user_comment2">
                                        <span class="date">{{ $comment->created_at }}</span>
                                    </div>
                                @endif
                            </div>
                        @empty
                        @endforelse
                    </div>
                    <div class="post_comment">
                        <form action="{{ route('comment.store', $post) }}" method="post" class="commentForm">
                            @csrf
                            <input type="text" name="description" class="description" placeholder="Add some comment..." required>
                            <input type="submit" value="Publish">
                        </form>
                        @error('description')
                        <p class="ml-3 text-danger">{{ $errors->first('description') }}</p>
                        @enderror
                    </div>
                </div>
            @empty
                <p>No Posts</p>
            @endforelse
        </div>

        {{ $posts->links() }}

        <div class="tags">
            <div class="current_user">
                @if(!Auth::user())
                    <div class="user_name">
                        <strong>
                            <span>No authenticated</span>
                        </strong>
                    </div>
                @endif
                @auth
                    <div class="user_name">
                        <a href="{{ route('user.profile') }}">{{ Auth::user()->name }}</a></div>
                    <div class="user_mail">{{ Auth::user()->email }}</div>
                @endauth
            </div>

            <div class="tag">
                <div class="tag_title">
                    <h4>Tags</h4>
                </div>
                <div class="tag_link">
                    @forelse($tags as $tag)
                        <a href="{{ route('tag_post', ['tag' => $tag]) }}">{{ $tag->title }}</a>
                    @empty
                        <p>No Tag</p>
                    @endforelse
                </div>
            </div>
        </div>
        @if(session('success_message'))
            <p>{{ session('success_message') }}</p>
        @endif
    </div>

    <div id="commentsWithSpecificTag">
        <div class="comments">
            <h4>Comments with <strong>{{ $tagName }}</strong></h4>
            @forelse($comments as $comment)
                <div class="specific_comment">
                    <p> <span><strong>{{ $comment->user->name }}</strong></span> : {{ $comment->description }}</p>
                    <div class="user_comment2">
                        <span class="date">{{ $comment->created_at }}</span>
                    </div>
                </div>

                @empty
                <div class="no_specific_comment">
                    <p>No comment with <span><strong>{{ $tagName }}</strong></span></p>
                </div>
            @endforelse
        </div>
    </div>
@endsection









