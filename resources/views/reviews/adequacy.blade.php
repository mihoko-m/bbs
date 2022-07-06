<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>充実度ランキング</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
@extends('layouts.app')

@section('content')
    <body>
        <div class="container">
            <div class="col-md-8">
                <h5>
                    充実度ランキング
                </h5>
            </div>
            <div class="row">
                <div class='reviews col-md-8'>
                    @foreach( $groups as $reviews )
                        <div class="card">
                            <div class="card-header">
                                    <i class="fa-solid fa-crown fa-lg"></i> <b>第{{ ($loop->index) + 1 }}位</b>
                                    {{ $reviews->teacher->name }}先生 {{ $reviews->subject->name }}
                            </div>
                            <div class="card-body">
                                <p>
                                    充実度
                                    <star-rating v-bind:increment="0.1" :star-size="20" :rating="{{ $reviews->adequacy }}" :read-only=true>
                                    </star-rating>
                                </p>
                                <div class="text-right">
                                    <a title ="btn btn-link " href="/reviews/teachers/{{ $reviews->teacher->id }}/subjects/{{ $reviews->subject->id }}">
                                        >>みんなのレビューを見る
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </body>
</html>
@endsection