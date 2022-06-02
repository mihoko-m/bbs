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
        <h1>SJ Info.履修登録支援サイト</h1>
        <div class='reviews'>
            @foreach ($reviews as $review)
                <div class='card'>
                    <div class="card-header">
                        <a href="/reviews/{{ $review->id }}">{{ $review->title }}</a>
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
        <div class='paginate'>
            {{ $reviews->links() }}
        </div>
        [<a href='/reviews/create'>新規投稿する</a>]
    </body>
</html>
@endsection