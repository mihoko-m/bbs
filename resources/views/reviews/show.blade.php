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
                    {{ $review->class }}
                    <div class="user">
                        @if(isset( $review->user ))
                            {{ $review->user->name }}
                        @endif
                    </div>
                    <div class="faculty">
                        @if(isset( $review->faculty ))
                            {{ $review->faculty->name }}
                        @endif
                    </div>
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
                            <a class="btn btn-link" href="/">戻る</a>
                            @if(isset( $review->user ) && Auth::user()->id === $review->user->id)
                                <a class="btn btn-link" href="/reviews/{{ $review->id }}/edit">編集する</a>
                            @endif
                            @if(isset( $review->user ) && Auth::user()->id === $review->user->id)
                                <form action="/reviews/{{ $review->id }}" id="form_{{ $review->id }}" method="post" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return Check()" class="btn btn-link">削除する</button> 
                                </form>
                            @endif
                    </div>
                </div>
            </div>
        </div>
        <script>
            function Check(){
                if(confirm("削除しますが本当によろしいですか？")){
                    return true;
                } else {
                    return false;
                }
            }
        </script>
    </body>
</html>
@endsection