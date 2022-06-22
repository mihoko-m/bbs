<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>回答投稿</title>
    </head>
@extends('layouts.app')

@section('content')
    <body>
        <div class="container">
            <div class="card">
                <div class="card-header">質問内容</div>
                <div class="card-body">{{ $question->body }}</div>
                <div class="card-header">{{ $question->user->name }}さんに回答する</div>
                    <form action="/reviews/{{ $question->review->id }}/questions/{{ $question->id }}" method="POST">
                        @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="body" class="col-md-4 col-form-label text-md-right">回答内容</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" name="answer[body]" placeholder="回答を300文字以内で入力してください。"></textarea>
                                            <p class="body__error" style="color:red">{{ $errors->first('answer.body') }}</p>
                                        </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <input type="submit" value="保存" class="btn btn-primary"/>
                                        <a class="btn btn-link" href="/reviews/{{ $question->review->id }}">戻る</a>
                                    </div>
                                </div>
                            </div>
                    </form>
            </div>
        </div>
    </body>
@endsection
</html>