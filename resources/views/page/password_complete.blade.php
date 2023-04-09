@extends('layout')
@section('header')
@include('loginheader')
@endsection
@section('content')
@section('title','パスワードリセット')
<div class="password-complete-box">
    <div class="password-complete-text">
        <h1>パスワードを変更しました。</h1>
        <a href="{{ route('login') }}">ログイン画面に戻る</a>
    </div>
</div>
@endsection