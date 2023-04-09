@extends('layout')
@section('header')
@include('header')
@endsection
@section('script')
@vite(['resources/js/wave.js'])
@endsection
@section('title','音楽詳細')
@section('content')
<div class="page">
    <div class="music-detail-waveform">
        <div class="music-detail-background">
            <img src="{{ asset('/storage/img/'.$music_data->image) }}">
        </div>
        <div class="music-detail-waveitems">
            <div class="music-detail-image">
                <img src="{{ asset('/storage/img/'.$music_data->image) }}">
            </div>
            <div class="music-detail-link">
                <div class="playlist">
                    <a href="{{  asset('storage/audio/'.$music_data->music_path)  }}" class="list-group-item">
                        <div class="music-detail-info">
                            <h1>{{ $music_data->music_name  }}</h1>
                            <h3>{{ $music_data->category}}</h3>
                        </div>
                    </a>
                </div>
                <div class="musicplaypause-button">
                    <span class="playpause"><i class="fa-solid fa-play"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="music-detail-form">
        <div class="music-detail-user">
            <img src="{{ asset('storage/img/user_img/'.$user_data->image) }}">
            <div class="music-detail-username">
                <p>投稿者名</p>
                <a href="{{ route('other_user',['id' => $user_data->id])  }}">
                    <h2>{{ $user_data->name  }}</h2>
                </a>
            </div>
            <div class="music-detail-userdetail">
                <h5>自己紹介</h5>
                @if($user_data->self_introduction == null)
                <p class="no-comment">コメントがありません</p>
                @else
                <p>{{ $user_data->self_introduction  }}</p>
                @endif
            </div>
        </div>
        <div class="music-detail-comment">
            <div class="music-comment">
                <h1>説明</h1>
                <p>{{ $music_data->description }}</p>
            </div>
            <div class="user-comment">
                <div class="user-comment-title">
                    <h1>コメント欄</h1>
                    @guest
                    <span class="error-message">*コメントするにはログインする必要があります。</span>
                    @endguest
                </div>
                <div class="comment-input-area">
                    <input type="hidden" name="music_id" class="comment-music-id" value="{{  $music_data->id  }}">
                    <textarea type="text" name="comment" class="comment-input"></textarea>
                    @auth
                    <button class="comment-input-button" disabled>送信する</button>
                    @endauth
                </div>

                <div class="comment-body">
                    <div class="comment-row">
                        <div class="comment-update"></div>
                        <div class="comment-default">
                            @foreach($comments as $comment)
                            <div class="comment">
                                <div class="comment-left">
                                    <img src="{{  asset('storage/img/user_img/'.$comment['user']->image) }}">
                                </div>
                                <div class="comment-right">
                                    <div class="comment-body-user">
                                        {{ $comment['user']->name }}
                                        <span class="comment-body-time">
                                            {{ $comment->created_at }}
                                        </span>
                                    </div>
                                    <div class="comment-body-usercomment">
                                        {!! nl2br(e($comment->comment)) !!}
                                    </div>
                                </div>
                                <div class="replay-button">
                                    <i class="fa-solid fa-reply"></i>返信する
                                </div>
                            </div>
                            <div class="replay-input-area" style="display:none">
                                <input type="hidden" name="music_id" class="replay-music-id" value="{{  $music_data->id  }}">
                                <input type="hidden" name="comment_id" class="replay-comment-id" value="{{  $comment->id  }}">
                                <textarea type="text" name="comment" class="replay-input"></textarea>
                                <div class="replay-select-button">
                                    <button class="replay-cancel-button">キャンセル</button>
                                    <button class="replay-input-button" disabled>送信する</button>
                                </div>
                            </div>

                            @foreach($comment['comments_replay'] as $comment_replay)
                            <div class="comment-replay">
                                <div class="comment-left">
                                    <img src="{{  asset('storage/img/user_img/'.$comment_replay['user']->image)}}">
                                </div>
                                <div class="comment-right">
                                    <div class="comment-body-user">
                                        {{ $comment_replay['user']->name }}
                                        <span class="comment-body-time">
                                            {{ $comment_replay->created_at }}
                                        </span>
                                    </div>
                                    <div class="comment-body-usercomment">
                                        {!! nl2br(e($comment_replay->comment)) !!}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="commentreplay-update">

                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="music-player" style="display: none;">
    <div class="music-player-items">
        <div class="music-player-buttn">
            <span class="playback"><i class="fa-solid fa-backward-step"></i></span>
            <span class="play"><i class="fa-solid fa-play"></i></span>
            <span class="pause" style="display:none;"><i class="fa-solid fa-stop"></i></span>
            <span class="playnext"><i class="fa-solid fa-forward-step"></i></span>
        </div>
        <div class="music-player-info">
        </div>
        <div class="music-player-time">
            <div class="current">0:00</div>
            <div class="slash">/</div>
            <div class="duration"></div>
        </div>
        <div class="music-player-wave">
            <div class="waveform"></div>
        </div>
        <div class="volume-button">
            <i class="fa-solid fa-volume-high"></i>
            <input type="range" class="volume" min="0" max="1" value="0.5" step="0.1" orient="vertical" style="display:none">
        </div>
    </div>
</div>
@endsection