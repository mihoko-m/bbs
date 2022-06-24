<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>学部・学科別授業評価一覧</title>
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
                <form action="/faculties/{{ $faculty->id }}" method="GET">
                    <div class="input-group">
                        <input type="search_subject" class="form-control input-group-prepend" 
                        placeholder="科目名を入力" name="search_subject" value="@if (isset($search_subject)) {{ $search_subject }} @endif"></input>
                        <input type="search_teacher" class="form-control input group-prepend" 
                        placeholder="講師名を入力" name="search_teacher" value="@if (isset($search_teacher)) {{ $search_teacher }} @endif"></input>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> 検索
                        </button>
                    </div>
            <br>
            <div class="col-md-8">
                <h5>{{ $faculty->name }} {{ $faculty->department_name }} 授業評価一覧 
                    @if (isset($order))
                        @if($order === "credit")
                            単位取得度が高い順
                        @elseif($order === "adequacy")
                            充実度が高い順
                        @endif
                    @else
                        新着順
                    @endif    
                </h5>
                並び替え：
                    <button type="submit" class="btn btn-link" name="order" value="new">新着順</button>
                    <button type="submit" class="btn btn-link" name="order" value="credit">単位取得度が高い順</button>
                    <button type="submit" class="btn btn-link" name="order" value="adequacy">充実度が高い順</button>
                </form>
                <div class="text-md-right">
                @if (count($reviews) >0)
                    全{{ $reviews->total() }}件中 
                    {{  ($reviews->currentPage() -1) * $reviews->perPage() + 1}} - 
                    {{ (($reviews->currentPage() -1) * $reviews->perPage() + 1) + (count($reviews) -1)  }}件のデータが表示されています。
                @else
                    データがありません...　
                @endif
                <a class="btn btn-primary" href='/reviews/create' role="button">新規投稿する</a>
                </div>
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
                                    <a title ="btn btn-link" href="/reviews/{{ $review->id }}">>>レビューの詳細を見る</a>
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
        </div>
    </body>
</html>
@endsection