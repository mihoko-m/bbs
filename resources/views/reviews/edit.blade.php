<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>レビュー編集</title>
    </head>
@extends('layouts.app')

@section('content')
    <body>
        <div class="container">
            <div class="card">
                <div class="card-header">投稿編集</div>
                    <form action="/reviews/{{ $review->id }}" method="POST">
                        @csrf
                        @method('PUT')
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="subject" class="col-md-4 col-form-label text-md-right">科目名</label>
                                        <div class="col-md-6">
                                            <input type="text" name="subject[name]" value="{{ $review->subject->name }}"/>
                                            <p class="title__error" style="color:red">{{ $errors->first('subject.name') }}</p>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="faculty" class="col-md-4 col-form-label text-md-right">学部・学科名</label>
                                        <div class="col-md-6">
                                            <select name="review[faculty_id]">
                                                    @if(!isset( $review->faculty ))
                                                        <option hidden>選択してください</option>
                                                        @foreach($faculties as $faculty)
                                                            <option value="{{ $faculty->id }}">{{ $faculty->name }} {{ $faculty->department_name }}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach($faculties as $faculty)
                                                            @if( $faculty->id === $review->faculty->id )
                                                                <option value="{{ $faculty->id }}" selected>{{ $faculty->name }} {{ $faculty->department_name }}</option>
                                                            @else
                                                                <option value="{{ $faculty->id }}">{{ $faculty->name }} {{ $faculty->department_name }}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                            </select>
                                        </div> 
                                </div>
                                <div class="form-group row">
                                    <label for="teacher" class="col-md-4 col-form-label text-md-right">講師名</label>
                                        <div class="col-md-6">
                                            <input type="text" name="teacher[name]" placeholder="講師名" value="{{ $review->teacher->name }}"/>
                                            <p class="title__error" style="color:red">{{ $errors->first('teacher.name') }}</p>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="evaluation" class="col-md-4 col-form-label text-md-right">成績評価</label>
                                        <div class="col-md-8">
                                            @foreach($evaluations as $evaluation)
                                                <input type="radio" name="review[evaluation_id]" value="{{ $evaluation->id }}" @if( $review->evaluation->id === $evaluation->id) checked @endif/>
                                                    {{ $evaluation->name }}
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
                                            <textarea class="form-control" name="review[body]">{{ $review->body }}</textarea>
                                            <p class="body__error" style="color:red">{{ $errors->first('review.body') }}</p>
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