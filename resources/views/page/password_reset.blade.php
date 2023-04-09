@extends('layout')
@section('header')
@include('loginheader')
@endsection
@section('title','パスワードリセット')
@section('content')
<div class="password-reset-form">
    <div class="password-reset-icon">
        <h1>パスワード再設定</h1>
        @if($errors->has('password_reset_error'))
        <span class="error-message">{{ $errors->first('password_reset_error') }}</span>
        @endif
    </div>
    <form method="POST" action="{{ route('send_email')}}">
        @csrf
        <div class="password-reset-area">
            <lavel>
                メールアドレス:
                @if($errors->has('email'))
                <span class="error-message">{{ $errors->first('email') }}</span>
                @endif
                <input type="email" name="email" value="{{ old('name') }}">
            </lavel>
        </div>

        <div class="email-send-button">
            <button>送信</button>
        </div>
    </form>
</div>
@endsection