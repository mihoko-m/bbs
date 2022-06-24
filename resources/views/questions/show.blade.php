<!DOCTYPE HTML>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>質問内容</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">
    </head>
@extends('layouts.app')

@section('content')
    <body>
        <div class="container">
            <a class="btn btn-link" href="/reviews/{{ $review->id }}"><<レビュー詳細画面に戻る</a>
            <h5>質問内容</h5>
            <div class="card">
                <div class="card-header">
                    {{ $question->user->name }}さんからの質問
                </div>
                <div class="card-body">
                    <div class="question-body">
                        {{ $question->body }}
                        @if (Auth::user()->id === $question->user->id)
                        <form action="/reviews/{{ $review->id }}/questions/{{ $question->id }}" id="form_{{ $question->id }}" method="post" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return Check()" class="btn btn-link">削除する</button> 
                        </form>
                        @endif
                    </div>
                </div>
                <div class="card-header">
                    {{ $review->user->name }}さんからの回答
                </div>
                <div class="card-body">
                    @if(!isset( $question->answer))
                        <p>回答はまだありません。</p>
                        @if(Auth::user()->id === $review->user->id)
                            <a class="btn btn-link" href="/reviews/{{ $review->id }}/questions/{{ $question->id }}/answers/create">回答する</a>
                        @endif
                    @elseif(isset( $question->answer))
                        {{ $question->answer->body }}
                        @if(Auth::user()->id === $review->user->id)
                            <form action="/reviews/{{ $review->id }}/questions/{{ $question->id }}/answers/{{ $question->answer->id }}" id="form_{{ $question->answer->id }}" method="post" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return Check()" class="btn btn-link">削除する</button> 
                            </form>
                        @endif
                    @endif
                </div>
                @foreach ($replies as $reply)
                    <div class="card-header">
                        {{ $reply->user->name }}
                    </div>
                    <div class="card-body">
                        {{ $reply->body }}
                        @if(Auth::user()->id === $reply->user->id)
                            <form action="/reviews/{{ $review->id }}/questions/{{ $question->id }}/answers/{{ $question->answer->id }}/replies/{{ $reply->id }}" id="form_{{ $reply->id }}" method="post" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return Check()" class="btn btn-link">削除する</button> 
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
                @if (Auth::user()->id === $question->user->id || Auth::user()->id === $review->user->id)
                    <br>
                    <div class="card">
                        <div class="card-header">
                            新規リプライ
                        </div>
                        <form action="/reviews/{{ $review->id }}/questions/{{ $question->id }}/answers/{{ $question->answer->id }}/replies" method="POST">
                            @csrf
                                <textarea class="form-control" name="reply[body]" placeholder="返答内容を300文字以内で入力してください。"></textarea>
                                <p class="body__error" style="color:red">{{ $errors->first('reply.body') }}</p>
                                <div class="text-right">
                                    <input type="submit" value="返答する" class="btn btn-link"/>
                                </div>
                        </form>
                    </div>
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