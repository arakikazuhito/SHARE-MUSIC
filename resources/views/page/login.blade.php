@extends('layout')
@section('header')
@include('loginheader')
@endsection
@section('title','ログイン')
@section('content')
<div class="login-form">
    <div class="login-icon">
        <h1>Login</h1>
        @if($errors->has('login_error'))
        <span class="error-message">{{ $errors->first('login_error') }}</span>
        @endif
    </div>
    <div class="login-text">
        <form action="{{ route('logincomplete') }}" method="POST">
            @csrf
            <div class="login-post-area">
                <lavel>
                    メールアドレス:
                    @if($errors->has('email'))
                    <span class="error-message">{{ $errors->first('email') }}</span>
                    @endif
                    <input type="email" name="email" value="{{ old('name') }}">
                </lavel>
            </div>
            <div class="login-post-area">
                <lavel>
                    パスワード:
                    @if($errors->has('password'))
                    <span class="error-message">{{ $errors->first('password') }}</span>
                    @endif
                    <input type="password" name="password" value="{{ old('password') }}" autocomplete="off">
                </lavel>
            </div>
            <div class="forgot-password">パスワード忘れた方は<a href="{{ route('password_reset')  }}">こちら</a></div>
            <div class="login-button-area">
                <button type="submit">ログイン</button>
            </div>
        </form>
    </div>
    <div class="sign-up">
        <p>アカウントをお持ちですか？<a href="{{ route('passwordreset')  }}"></a></p>
        <p><a href="{{ route('signup') }}"> 新規登録</a></p>
    </div>
</div>
@endsection