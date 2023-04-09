@extends('layout')
@section('header')
@include('loginheader')
@endsection
@section('title','登録完了')
@section('content')
<div class="register-box">
    <div class="register-text">
        <h1>新規登録が完了しました</h1>
        <a href="{{ route('login') }}">投稿画面に戻る</a>
    </div>
</div>
@endsection