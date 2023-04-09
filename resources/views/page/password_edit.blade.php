@extends('layout')
@section('header')
@include('loginheader')
@endsection
@section('title','パスワード編集')
@section('content')
<div class="password-edit-form">
    <div class="password-edit-icon">
        <h1>パスワード再設定</h1>
        @if($errors->has('password_edit_error'))
        <span class="error-message">{{ $errors->first('password_edit_error') }}</span>
        @endif
    </div>
    <form method="POST" action="{{ route('password_update')}}">
        @csrf
        <input type="hidden" name="reset_token" value="{{ $userToken->token }}">
        <div class="password-edit-area">
            <lavel>
                パスワード:
                @if($errors->has('password'))
                <span class="error-message">{{ $errors->first('password') }}</span>
                @endif
                <input type="password" name="password" value="{{ old('password') }}">
            </lavel>
        </div>
        <div class="password-update-button">
            <button>更新</button>
        </div>
    </form>
</div>
@endsection