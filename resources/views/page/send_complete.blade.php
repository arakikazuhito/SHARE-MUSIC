@extends('layout')
@section('header')
@include('loginheader')
@endsection
@section('title','パスワードリセット')
@section('content')
<div class="send-complete-box">
    <div class="send-complete-text">
        <h1>メールを送信しました。</h1>
        <a href="{{ route('login') }}">TOPへ</a>
    </div>
</div>
@endsection