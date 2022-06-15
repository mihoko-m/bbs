<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>授業評価一覧</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script src="https://kit.fontawesome.com/448df20bce.js" crossorigin="anonymous"></script>
    </head>
@extends('layouts.app')

@section('content')
    <body>
        <div class="container">
            <div class="col-md-8">
            <h5>授業評価検索</h5>
            </div>
                <form action="/" method="GET">
                    <div class="input-group">
                        <input type="search_subject" class="form-control input-group-prepend" 
                        placeholder="科目名を入力" name="search_subject" value="@if (isset($search_subject)) {{ $search_subject }} @endif"></input>
                        <input type="search_teacher" class="form-control input group-prepend" 
                        placeholder="講師名を入力" name="search_teacher" value="@if (isset($search_teacher)) {{ $search_teacher }} @endif"></input>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> 検索
                        </button>
                    </div>
                </form>
            <br>
            <div class="col-md-8">
                <h5>授業評価一覧</h5>
            </div>
            <div class="row">
                <div class='reviews col-md-8'>
                    @foreach ($reviews as $review)
                        <div class='card'>
                            <div class="card-header">
                                <div class="row">
                                    <div class="subject col-md-6">
                                        @if(isset( $review->subject ))
                                            <b>{{ $review->subject->name }}</b>
                                        @else
                                            <b>{{ $review->class }}</b>
                                        @endif
                                    </div>
                                    <div class="time col-md-6 text-md-right">
                                        投稿日時：{{ $review->created_at }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="faculty col-md-6">
                                        @if(isset( $review->faculty ))
                                            <a href="/faculties/{{ $review->faculty->id }}">
                                                {{ $review->faculty->name }} {{ $review->faculty->department_name }}
                                            </a>
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
                    <br>
                </div>
                <div class="contents col-md-4">
                    <div class="card">
                        <div class="card-header">
                            コンテンツ
                        </div>
                        <div class="card-body">
                            <div>
                                <a>>単位取得度ランキング</a>
                            </div>
                            <div>
                                <a>>充実度ランキング</a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header">
                            学部・学科別
                        </div>
                        <div class="card-body">
                            @foreach ($faculties as $faculty)
                                <div>
                                    <p><a href="/faculties/{{ $faculty->id }}">>{{ $faculty->name }} {{ $faculty->department_name }}</a></p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class='pagination'>
                {{ $reviews->appends(request()->query())->links() }}
            </div>
            <a class="btn btn-primary" href='/reviews/create'>新規投稿する</a>
        </div>
    </body>
</html>
@endsection