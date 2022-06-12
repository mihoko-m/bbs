@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Review</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="col-md-8">
                <h5>授業評価一覧</h5>
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
                </div>
            </div>
            <div class='pagination'>
                {{ $reviews->links() }}
            </div>
            <a class="btn btn-primary" href='/reviews/create'>新規投稿する</a>
        </div>
    </body>
</html>
@endsection