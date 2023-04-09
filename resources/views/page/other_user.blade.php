@extends('layout')
@section('header')
@include('header')
@endsection
@section('script')
@vite(['resources/js/wave.js'])
@endsection
@section('title','ユーザ画面')
@section('content')
<div class="show-user">
    <div class="user-image">
        <img src="{{ asset('storage/img/user_img/'.$user_data->image) }}">
    </div>
    <div class="profile">
        <table>
            <tr>
                <td>{{$user_data->name}}</td>
            </tr>
            <tr>
                @if($user_data->self_introduction !== null)
                <td>{{$user_data->self_introduction}}</td>
                @endif
            </tr>
        </table>
    </div>
</div>
<div class="playlist">
    @foreach($music_data as $music)
    <div class="playlist-items">
        <a href="{{  asset('storage/audio/'.$music->music_path)  }}" class="list-group-item">
            <div class="playlist-music-image">
                <img src="{{  asset('storage/img/'.$music->image)  }}">
            </div>
            <div class="playlist-info">
                <span data-url="{{ route('music_detail',['id'=>$music->id,'user_id'=>$user_data->id])  }}" class="musicdetail-link">
                    <h1>{{ $music->music_name  }}</h1>
                </span>
                <h3>{{ $music->category}}</h3>
            </div>
        </a>
    </div>
    @endforeach
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