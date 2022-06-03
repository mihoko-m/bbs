<!DOCTYPE HTML>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>投稿内容</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">
    </head>
@extends('layouts.app')

@section('content')
    <body>
        <div class="container">
            <div class='card'>
                <div class="card-header">
                    {{ $review->title }}
                </div>
                <div class="card-body">
                    <div class="get_credit">
                        単位取得度
　                      <star-rating :star-size="20" :rating="{{ $review->get_credit }}" :read-only=true>
　                      </star-rating>
                    </div>
                    <div class="adequacy">
                        充実度
　                      <star-rating :star-size="20" :rating="{{ $review->adequacy }}" :read-only=true>
　                      </star-rating>
                    </div>
                    <div class="show-body">
                        {{ $review->body}}
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <a class="btn btn-link" href="/">戻る</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
@endsection