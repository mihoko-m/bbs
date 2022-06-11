<!DOCTYPE HTML>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $user->name }}さんのマイページ</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">
    </head>
@extends('layouts.app')

@section('content')
    <body>
        <div class="container">
            <div class="title">
                <h5>{{ $user->name }}さんのマイページ</h5>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                {{ $user->name }}さんのプロフィール
                            </div>
                            <div class="card-body">
                                @if(isset( $user->faculty ) && isset( $user->profile ))
                                    <p>所属学部学科：{{ $user->faculty->name }}</p>
                                    <p>プロフィール：{{ $user->profile }}</p>
                                @elseif(isset( $user->faculty))
                                    <p>所属学部学科：{{ $user->faculty->name }}</p>    
                                @elseif(isset( $user->profile))
                                    <p>{{ $user->profile }}</p>
                                @else
                                    <p>プロフィールはまだ設定されていません。</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <h5>投稿一覧</h5>
            </div>
            <div class="row">
                <div class='reviews col-md-8'>
                    @foreach ($reviews as $review)
                        <div class='card'>
                            <div class="card-header">
                                @if(isset( $review->subject ))
                                    <b>{{ $review->subject->name }}</b>
                                @else
                                    <b>{{ $review->class }}</b>
                                @endif
                                <div class="row">
                                    <div class="faculty col-md-6">
                                        @if(isset( $review->faculty ))
                                            {{ $review->faculty->name }} {{ $review->faculty->department_name }}
                                        @endif
                                    </div>
                                    <div class="user col-md-6 text-md-right">
                                        @if(isset( $review->user ))
                                            投稿者：{{ $review->user->name }}
                                        @endif
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
            <div class='pagination'>
                {{ $reviews->links() }}
            </div>
        </div>
    </body>
</html>
@endsection