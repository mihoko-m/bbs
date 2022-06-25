<!DOCTYPE HTML>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>投稿内容</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">
    </head>
@extends('layouts.app')

@section('content')
    <body>
        <div class="container">
            <div class='card'>
                <div class="card-header">
                    @if(isset( $review->subject ))
                        <b>{{ $review->subject->name }}</b>
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
                    @if(isset($review->evaluation))
                        <div class="evaluation">
                            <p>成績評価：{{ $review->evaluation->name }}</p>
                        </div>
                    @endif
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
                    <div class="body">
                        <p>{{ $review->body}}</p>
                    </div>
                    <div class="row">
                            <a class="btn btn-link col-md-4" href="/" role="button">トップページに戻る</a>
                            <a class="btn btn-link col-md-4" href="/faculties/{{ $review->faculty->id }}" role="button">学部・学科別ページに戻る</a>
                            <a class="btn btn-link col-md-4" href="/?search_subject={{ $review->subject->name }}&search_teacher={{ $review->teacher->name }}" role="button">
                                同じ講義のレビューをすべてみる
                            </a>
                        <div class="w-100"></div>
                    @if(isset( $review->user ) && Auth::user()->id === $review->user->id)
                        <a class="btn btn-link col-md-4" href="/reviews/{{ $review->id }}/edit" role="button">編集する</a>
                    @else
                        <a class="btn btn-link" href='/questions/{{ $review->id }}/create'>この投稿に質問する</a>
                    @endif
                    </div>
                </div>
            </div>
            <br>
            @foreach ($questions as $question)
                <div class="card">
                    <div class="card-header">
                        {{ $question->user->name }}さんからの質問
                        <div class="text-right">
                        投稿日時：{{ $question->created_at }}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="question-body">
                            {{ $question->body }}
                            @if (Auth::user()->id === $question->user->id)
                                <form action="/reviews/{{ $review->id }}/questions/{{ $question->id }}" id="form_{{ $question->id }}" method="post" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return Check()" class="btn btn-dark">削除する</button> 
                                </form>
                            @endif
                        </div>
                    </div>
                    <div class="card-header">
                        {{ $review->user->name }}さんからの回答
                        @if(isset($question->answer))
                            <div class="text-right">
                                投稿日時：{{ $question->answer->created_at }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        @if(!isset($question->answer))
                            <p>回答はまだありません。</p>
                            @if(Auth::user()->id === $review->user->id)
                                <a class="btn btn-link" href="/reviews/{{ $review->id }}/questions/{{ $question->id }}/answers/create">回答する</a>
                            @endif
                        @elseif(isset($question->answer))
                        {{ $question->answer->body }}
                            @if(Auth::user()->id === $review->user->id)
                                <form action="/reviews/{{ $review->id }}/questions/{{ $question->id }}/answers/{{ $question->answer->id }}" id="form_{{ $question->answer->id }}" method="post" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return Check()" class="btn btn-dark">削除する</button> 
                                </form>
                            @endif
                        <a class="btn btn-link" href="/reviews/{{ $review->id }}/questions/{{ $question->id }}/answers/{{ $question->answer->id }}" role="button">詳細をみる</a>
                        @endif
                    </div>
                </div>
                <br>
            @endforeach
            @if(isset( $review->user ) && Auth::user()->id === $review->user->id)
                <form action="/reviews/{{ $review->id }}" id="form_{{ $review->id }}" method="post" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return Check()" class="btn btn-dark col">削除する</button> 
                </form>
            @endif
        </div>
        <script>
            function Check(){
                if(confirm("削除しますが本当によろしいですか？")){
                    return true;
                } else {
                    return false;
                }
            }
        </script>
    </body>
</html>
@endsection