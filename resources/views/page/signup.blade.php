@extends('layout')
@section('header')
@include('loginheader')
@endsection
@section('title','新規登録')
@section('content')
<div class="signup-form">
    <div class="signup-icon">
        <h1>Sign up</h1>
        @if($errors->has('signup_error'))
        <span class="error-message">{{ $errors->first('signup_error') }}</span>
        @endif
    </div>
    <div class="signup-text">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="signup-post-area">
                <lavel> ユーザ名:
                    @if($errors->has('name'))
                    <span class="error-message">{{ $errors->first('name') }}</span>
                    @endif
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="user name">
                </lavel>
            </div>
            <div class="signup-post-area">
                <lavel>
                    メールアドレス:
                    @if($errors->has('email'))
                    <span class="error-message">{{ $errors->first('email') }}</span>
                    @endif
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="mail address">
                </lavel>
            </div>
            <div class="signup-post-area">
                <lavel>
                    パスワード:
                    @if($errors->has('password'))
                    <span class="error-message">{{ $errors->first('password') }}</span>
                    @endif
                    <input type="password" name="password" placeholder="password">
                </lavel>
            </div>
            <div class="signup-button-area">
                <button type="submit" name="send">新規登録</button>
            </div>
        </form>
    </div>
</div>
@endsection