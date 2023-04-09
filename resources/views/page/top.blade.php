@extends('layout')
@section('header')
@include('header')
@endsection
@section('title','トップページ')
@section('script')
@vite(['resources/js/wave.js'])
@endsection
@section('content')
<div class="new-upload-box">
    <h1>新着</h1>
    <div class="new-upload-area">
        <ul class="music-box">
            @foreach($new_data as $music)
            <li class="music-items">
                <div class="music-image">
                    <a href="{{ route('music_detail',['id'=>$music->id,'user_id'=>$music->user_id]) }}"><img src="{{ asset('storage/img/'.$music->image) }}"></a>
                    <div class="music-text">
                        <div class="music-name"><a href="{{ route('music_detail',['id'=>$music->id,'user_id'=>$music->user_id]) }}">{{ $music->music_name }}</a></div>
                        <div class="music_user-name"><a href="{{ route('other_user',['id' => $music->user_id])  }}">{{ $music->name }}</a></div>
                        <div class="music-time-like">
                            <div class="music-time">
                                {{$music->created_at}}
                            </div>
                            <div class="music-like">
                                @auth
                                @if($music->isLikedBy($music))
                                <span class="likes">
                                    <i class="fa-solid fa-heart like-toggle liked" data-music-id="{{  $music->id }}"></i>
                                    <span class='like-counter'>{{$music->likes_count}}</span>
                                </span>
                                @else
                                <span class="likes">
                                    <i class="fa-solid fa-heart like-toggle" data-music-id="{{  $music->id }}"></i>
                                    <span class='like-counter'>{{$music->likes_count}}</span>
                                </span>
                                @endif
                                @endauth
                                @guest
                                <span class="likes">
                                    <i class="fa-solid fa-heart"></i>
                                    <span class='like-counter'>{{$music->likes_count}}</span>
                                </span>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
<div class="ranking-upload-box">
    <h1>ランキング</h1>
    <div class="ranking-upload-area">
        <ul class="music-box">
            @foreach($ranking_data as $music)
            <li class="music-items">
                <div class="music-image">
                    <a href="{{ route('music_detail',['id'=>$music->id,'user_id'=>$music->user_id]) }}"><img src="{{ asset('storage/img/'.$music->image) }}"></a>
                    <div class="music-text">
                        <div class="music-name"><a href="{{ route('music_detail',['id'=>$music->id,'user_id'=>$music->user_id]) }}">{{ $music->music_name }}</div></a>
                        <div class="music_user-name"><a href="{{ route('other_user',['id' => $music->user_id])  }}">{{ $music->name }}</div></a>
                        <div class="music-time-like">
                            <div class="music-time">
                                {{$music->created_at}}
                            </div>
                            <div class="music-like">
                                @auth
                                @if($music->isLikedBy($music))
                                <span class="likes">
                                    <i class="fa-solid fa-heart like-toggle liked" data-music-id="{{  $music->id }}"></i>
                                    <span class='like-counter'>{{$music->likes_count}}</span>
                                </span>
                                @else
                                <span class="likes">
                                    <i class="fa-solid fa-heart like-toggle" data-music-id="{{  $music->id }}"></i>
                                    <span class='like-counter'>{{$music->likes_count}}</span>
                                </span>
                                @endif
                                @endauth
                                @guest
                                <span class="likes">
                                    <i class="fa-solid fa-heart"></i>
                                    <span class='like-counter'>{{$music->likes_count}}</span>
                                </span>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
<div class="music-player" style="display:none">
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