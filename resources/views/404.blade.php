@extends('layouts.app')

@section('title')
404 Error
@endsection


@section('styles')
<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
<style>
    html, body {
        height: 100%;
    }

    body {
        margin: 0;
        padding: 0;
        width: 100%;
        color: #B0BEC5;
        display: table;
        font-weight: 100;
        font-family: 'Lato', sans-serif;
    }

    .content {
        text-align: center;
        display: inline-block;
    }

    .title {
        margin-top: 240px;
        font-size: 72px;
        margin-bottom: 40px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="content">
        <div class="title">{{ $exception->getMessage() }}</div>
    </div>
</div>
@endsection
