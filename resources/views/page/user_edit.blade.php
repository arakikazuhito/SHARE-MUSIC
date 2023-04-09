@extends('layout')
@section('header')
@include('header')
@endsection
@section('title','アカウント編集ページ')
@section('content')
<div class="user-edit-box">
    @if($errors->has('user_edit_error'))
    <p class="error-message">{{ $errors->first('user_edit_error') }}</p>
    @endif
    <div class="user-edit-image">
        <img id="edit-preview" src="{{  asset('storage/img/user_img/'.$user_data->image)}}">
    </div>
    <form action="{{ route('edit_complete') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="user-edit-item">
            <div class="user-edit-image-button">
                <label>画像を選択してください
                    <input type="file" name="image" id="edit-image" value="{{  $user_data->image  }}" accept="image/*">
                    @if($errors->has('image'))
                    <p class="error-message">{{ $errors->first('image') }}</p>
                    @endif
                </label>
            </div>
            <div class="user-edit-area">
                <lavel> ユーザ名:
                    @if($errors->has('name'))
                    <span class="error-message">{{ $errors->first('name') }}</span>
                    @endif
                    <input type="text" name="name" value="{{ $user_data->name }}">
                </lavel>
            </div>
            <div class="user-edit-area">
                <lavel>
                    自己紹介:
                    @if($errors->has('self_introduction'))
                    <span class="error-message">{{ $errors->first('self_introduction') }}</span>
                    @endif
                    <textarea type="text" name="self_introduction">{{$user_data->self_introduction}}</textarea>
                </lavel>
            </div>
            <div class="user-edit-button">
                <button type="submit" name="send">更新</button>
            </div>
        </div>
    </form>
</div>
@endsection