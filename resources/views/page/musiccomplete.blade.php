@extends('layout')
@section('header')
@include('header')
@endsection
@section('title','完了')
@section('content')
<div class="music-complete-box">
    <div class="music-complete-text">
        <h1>投稿が完了しました</h1>
        <a href="{{ route('post') }}">投稿画面に戻る</a>
    </div>
</div>
@endsection('content')