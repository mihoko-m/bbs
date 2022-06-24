<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>質問投稿</title>
    </head>
@extends('layouts.app')

@section('content')
    <body>
        <div class="container">
            <div class="card">
                <div class="card-header">質問投稿</div>
                    <form action="/questions/{{ $review->id }}" method="POST">
                        @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="body" class="col-md-4 col-form-label text-md-right">質問内容</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" name="question[body]" placeholder="質問を300文字以内で入力してください。"></textarea>
                                            <p class="body__error" style="color:red">{{ $errors->first('question.body') }}</p>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-8 offset-md-4">
                                        <input type="submit" value="保存" class="btn btn-primary"/>
                                        <a class="btn btn-link" href="/reviews/{{ $review->id }}">戻る</a>
                                    </div>
                                </div>
                            </div>
                    </form>
            </div>
        </div>
    </body>
@endsection
</html>