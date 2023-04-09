@extends('layout')
@section('header')
@include('header')
@endsection
@section('title','音楽投稿')
@section('content')
<form action="{{ route('confirm') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="music-post-box">
        <h1>音楽アップロード</h1>
        <div class="center">
            @if($errors->has('post_error'))
            <span class="error-message">{{ $errors->first('post_error') }}</span>
            @endif
            <div class="left">
                <div class="post-area">
                    <img id="preview" src="{{ asset('/img/no_image500.jpeg') }}">
                </div>
                <div class="post-area">
                    <label>画像を選択してください
                        <input type="file" name="image" id="image" accept="image/*">
                        @if($errors->has('image'))
                        <p class="error-message">{{ $errors->first('image') }}</p>
                        @endif
                    </label>
                </div>
            </div>


            <div class="right">
                <div class="post-area">
                    <p class="file-name">選択されていません
                        @if($errors->has('music_path'))
                        <span class="error-message">{{ $errors->first('music_path') }}</span>
                        @endif
                    </p>
                    <label>音楽を選択してください
                        <input type="file" name="music_path" id="music_path">
                    </label>
                </div>


                <div class="post-area">
                    <h2>曲名
                        @if($errors->has('music_name'))
                        <span class="error-message">{{ $errors->first('music_name') }}</span>
                        @endif
                    </h2>
                    <input type="text" name="music_name" id="music_name" value="{{ old('music_name') }}" wrap="hard">
                </div>


                <div class="post-area">
                    <h2>カテゴリー
                        @if($errors->has('category'))
                        <span class="error-message">{{ $errors->first('category') }}</span>
                        @endif
                    </h2>
                    <select type="text" name="category">
                        <option value=''>カテゴリーを選択してください</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->name }}" @if($category->name == old('category')) selected @endif>{{ $category->name}}</option>
                        @endforeach
                    </select>
                </div>


                <div class=" post-area">
                    <h2>説明 @if($errors->has('description'))
                        <span class="error-message">{{ $errors->first('description') }}</span>
                        @endif
                    </h2>
                    <textarea type="text" name="description">{{ old('description') }}</textarea>
                </div>
            </div>
        </div>
        <div class="button-area">
            <button type="submit" name="send">送信</button>
        </div>
    </div>
</form>
@endsection