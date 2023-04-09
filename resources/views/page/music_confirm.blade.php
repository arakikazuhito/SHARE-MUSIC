@extends('layout')
@section('header')
@include('header')
@endsection
@section('title','確認')
@section('content')
<form action="{{ route('complete') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="music-confirm-box">
        <h1>音楽アップロード</h1>
        <div class="center">
            <div class="left">
                <div class="confirm-area">
                    @if($image == 'no_image500.jpeg')
                    <img id="preview" src='{{ asset("img/$image")}}'>
                    @else
                    <img id="preview" src='{{ asset("img/tmp/$image")}}'>
                    @endif
                    <input type="hidden" name="image" id="image" value="{{ $image }}" accept="image/*">
                </div>
            </div>


            <div class="right">
                <div class="confirm-area">
                    <h2>楽曲データ</h2>
                    <audio controls controlslist="nodownload">
                        <source src='{{ asset("/audio/tmp/$music_path") }}' type="audio/wav" />
                        <source src='{{ asset("/audio/tmp/$music_path") }}' type="audio/mp3" />
                        <source src='{{ asset("/audio/tmp/$music_path") }}' type="audio/ogg" />
                    </audio>
                    <input type="hidden" name="music_path" id="music_path" value="{{ $music_path }}" accept="audio/*">
                </div>


                <div class="confirm-area">
                    <h2>曲名</h2>
                    <div class="input">
                        {{ $music_data['music_name'] }}
                    </div>
                    <input type="hidden" name="music_name" id="music_name" value="{{ $music_data['music_name'] }}">
                </div>


                <div class="confirm-area">
                    <h2>カテゴリー</h2>
                    <div class="input">
                        {{ $music_data['category'] }}
                    </div>
                    <input type="hidden" name="category" id="category" value="{{ $music_data['category'] }}">
                </div>


                <div class="confirm-area">
                    <h2>説明</h2>
                    <div class="input">
                        {!! nl2br(e($music_data['description'])) !!}
                    </div>
                    <input type="hidden" name="description" id="description" value="{{ $music_data['description'] }}">
                </div>
            </div>
        </div>
        <div class="button-area-back">
            <button type="submit" class="back" name="action" value="back">戻る</button>
            <button type="submit" class="send" name="action" value="send">送信</button>
        </div>
    </div>
</form>
@endsection