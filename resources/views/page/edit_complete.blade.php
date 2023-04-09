@extends('layout')
@section('header')
@include('header')
@endsection
@section('title','ユーザ編集')
@section('content')
<div class="useredit-complete-box">
    <div class="useredit-complete-text">
        <h1>編集が完了しました</h1>
        <a href="{{  route('top') }}">トップページに戻る</a>
    </div>
</div>
@endsection