<!DOCTYPE HTML>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $user->name }}さんのページ</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">
    </head>
@extends('layouts.app')

@section('content')
    <body>
        <div class="container">
            <div class="title col-md-12">
                <h5>{{ $user->name }}さんのページ</h5>
                @if(isset( $user->image_path))
                <div class="text-md-right">
                    <img src="{{ $user->image_path }}" class="icon">
                </div>
                @endif
                <br>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            {{ $user->name }}さんのプロフィール
                        </div>
                        <div class="card-body">
                            @if(isset( $user->faculty ) && isset( $user->profile ))
                                <p>所属学部学科：{{ $user->faculty->name }} {{ $user->faculty->department_name }}</p>
                                <p>{{ $user->profile }}</p>
                            @elseif(isset( $user->faculty))
                                <p>所属学部学科：{{ $user->faculty->name }}</p>    
                            @elseif(isset( $user->profile))
                                <p>{{ $user->profile }}</p>
                            @else
                                <p>プロフィールはまだ設定されていません。</p>
                            @endif
                                
                            @if( Auth::user()->id === $user->id )
                                <a class="btn btn-link" href="/users/{{Auth::user()->id}}/mypage/edit">プロフィールを編集する</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <h5 class="col-md-12">投稿一覧</h5>
            <div class="row">
                <div class="reviews col-md-12">
                    @if( Auth::user()->id === $user->id )
                    <div class="text-md-right">
                        <a class="btn btn-primary" href='/reviews/create'>新規投稿する</a>
                    </div>
                    @endif
                    @foreach ($reviews as $review)
                        <div class='card'>
                            <div class="card-header">
                                <b>{{ $review->subject->name }}</b>
                                <div class="row">
                                    <div class="faculty col-md-6">
                                        {{ $review->faculty->name }} {{ $review->faculty->department_name }}
                                    </div>
                                    <div class="user col-md-6 text-md-right">
                                        <i class="fa-solid fa-circle-user fa-lg"></i>
                                        <a href="/users/{{ $review->user->id }}">{{ $review->user->name }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="get_credit">
                                    <p>
                                        単位取得度
                                        <star-rating :star-size="20" :rating="{{ $review->get_credit }}" :read-only=true>
                                        </star-rating>
                                    </p>
                                </div>
                                <div class="adequacy">
                                    <p>
                                        充実度
                                        <star-rating :star-size="20" :rating="{{ $review->adequacy }}" :read-only=true>
                                        </star-rating>
                                    </p>
                                </div>
                                <div class="text-right">
                                    <a title ="btn btn-link " href="/reviews/{{ $review->id }}">>>レビューの詳細を見る</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <br>
            <h5 class="col-md-12">お気に入り一覧</h5>
            <div class="row">
                <div class="favorites col-md-12">
                    @foreach ($favorites as $favorite)
                        <div class='card'>
                            <div class="card-header">
                                <b>{{ $favorite->subject->name }}</b>
                                <div class="row">
                                    <div class="faculty col-md-6">
                                        {{ $favorite->faculty->name }} {{ $favorite->faculty->department_name }}
                                    </div>
                                    <div class="user col-md-6 text-md-right">
                                        <i class="fa-solid fa-circle-user fa-lg"></i>
                                        <a href="/users/{{ $favorite->user->id }}">{{ $favorite->user->name }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="get_credit">
                                    <p>
                                        単位取得度
                                        <star-rating :star-size="20" :rating="{{ $favorite->get_credit }}" :read-only=true>
                                        </star-rating>
                                    </p>
                                </div>
                                <div class="adequacy">
                                    <p>
                                        充実度
                                        <star-rating :star-size="20" :rating="{{ $favorite->adequacy }}" :read-only=true>
                                        </star-rating>
                                    </p>
                                </div>
                                <div class="text-right">
                                    <a title ="btn btn-link " href="/reviews/{{ $favorite->id }}">>>レビューの詳細を見る</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class='pagination'>
                {{ $reviews->links() }}
            </div>
        </div>
    </body>
</html>
@endsection