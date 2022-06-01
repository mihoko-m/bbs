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
                <div class='review'>
                    <h2 class='title'>
                        <a href="/reviews/{{ $review->id }}">{{ $review->title }}</a>
                    </h2>
                    <p class='body'>{{ $review->body }}</p>
                </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $reviews->links() }}
        </div>
    </body>
</html>
@endsection