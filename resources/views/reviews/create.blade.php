<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>レビュー投稿</title>
    </head>
@extends('layouts.app')

@section('content')
    <body>
        <div class="container">
            <div class="card">
                <div class="card-header">新規投稿</div>
                    <form action="/reviews" method="POST">
                        @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="title" class="col-md-4 col-form-label text-md-right">授業名</label>
                                        <div class="col-md-6">
                                            <input type="text" name="review[class]" placeholder="授業名"/>
                                            <p class="title__error" style="color:red">{{ $errors->first('review.class') }}</p>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="subject" class="col-md-4 col-form-label text-md-right">科目名</label>
                                        <div class="col-md-6">
                                            <input type="text" name="subject[name]" placeholder="科目名"/>
                                            <p class="title__error" style="color:red">{{ $errors->first('subject.name') }}</p>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="faculty" class="col-md-4 col-form-label text-md-right">学部・学科名</label>
                                        <div class="col-md-6">
                                            <select name="review[faculty_id]">
                                                    <option hidden>選択してください</option>
                                                @foreach($faculties as $faculty)
                                                    <option value="{{ $faculty->id }}">{{ $faculty->name }} {{ $faculty->department_name }}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                </div>
                                <div class="form-group row">
                                    <label for="teacher" class="col-md-4 col-form-label text-md-right">講師名</label>
                                        <div class="col-md-6">
                                            <input type="text" name="teacher[name]" placeholder="講師名"/>
                                            <p class="title__error" style="color:red">{{ $errors->first('teacher.name') }}</p>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="evaluation" class="col-md-4 col-form-label text-md-right">成績評価</label>
                                        <div class="col-md-8">
                                            @foreach($evaluations as $evaluation)
                                                <input type="radio" name="review[evaluation_id]" value="{{ $evaluation->id }}"/>
                                                    <small>{{ $evaluation->name }}</small>
                                            @endforeach
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="get_credit" class="col-md-4 col-form-label text-md-right">単位取得度</label>
                                        <div class="col-md-6">
                                            <select name="review[get_credit]">
                                                <option value="1">★☆☆☆☆ かなり厳しい</option>
                                                <option value="2">★★☆☆☆ 厳しい</option>
                                                <option value="3" selected>★★★☆☆ 普通</option>
                                                <option value="4">★★★★☆ 簡単</option>
                                                <option value="5">★★★★★ かなり簡単</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="adequacy" class="col-md-4 col-form-label text-md-right">充実度</label>
                                        <div class="col-md-6">
                                            <select name="review[adequacy]">
                                                <option value="1">★☆☆☆☆ かなり物足りない</option>
                                                <option value="2">★★☆☆☆ 物足りない</option>
                                                <option value="3" selected>★★★☆☆ 普通</option>
                                                <option value="4">★★★★☆ 充実</option>
                                                <option value="5">★★★★★ かなり充実</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="body" class="col-md-4 col-form-label text-md-right">講義内容</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" name="review[body]" placeholder="講義の詳細内容を入力してください。"></textarea>
                                            <p class="body__error" style="color:red">{{ $errors->first('review.body') }}</p>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-8 offset-md-4">
                                        <input type="submit" value="保存" class="btn btn-primary"/>
                                        <a class="btn btn-link" href="/">戻る</a>
                                    </div>
                                </div>
                            </div>
                    </form>
            </div>
        </div>
    </body>
@endsection
</html>