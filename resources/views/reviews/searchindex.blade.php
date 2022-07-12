<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>絞り込み一覧</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
@extends('layouts.app')

@section('content')
    <body>
        <div class="container">
            <div class="col-md-8">
                <h5>
                    {{ $teacher->name }}先生の講義 {{ $subject->name }}
                </h5>
                <p>
                    平均単位取得度
                    <star-rating v-bind:increment="0.1" :star-size="20" :rating="{{ $get_credit }}" :read-only=true>
                    </star-rating>
                </p>
                <p>
                    平均充実度
                    <star-rating v-bind:increment="0.1" :star-size="20" :rating="{{ $adequacy }}" :read-only=true>
                    </star-rating>
                </p>
            </div>
            <div class="row">
                <div class='reviews col-md-8'>
                   @foreach ($reviews as $review)
                        <div class='card'>
                            <div class="card-header">
                                <div class="row">
                                    <div class="subject col-md-6">
                                        <b>{{ $review->subject->name }}</b>
                                    </div>
                                    <div class="time col-md-6 text-md-right">
                                        投稿日時：{{ $review->created_at }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="faculty col-md-6">
                                        <a href="/faculties/{{ $review->faculty->id }}">
                                            {{ $review->faculty->name }} {{ $review->faculty->department_name }}
                                        </a>
                                        {{ $review->teacher->name }}先生
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
        </div>
    </body>
</html>
@endsection