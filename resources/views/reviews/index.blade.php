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
                                <a title ="btn btn-link" href="/reviews/{{ $review->id }}">{{ $review->class }}</a>
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