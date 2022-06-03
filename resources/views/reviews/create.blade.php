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
                                    <label for="title" class="col-md-4 col-form-label text-md-right">科目名</label>
                                        <div class="col-md-6">
                                            <input type="text" name="review[title]" placeholder="科目名"/>
                                            <p class="title__error" style="color:red">{{ $errors->first('review.title') }}</p>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="get_credit" class="col-md-4 col-form-label text-md-right">単位取得度</label>
                                        <div class="col-md-6">
                                            <select name="review[get_credit]">
                            <option value="1">★☆☆☆☆</option>
                            <option value="2">★★☆☆☆</option>
                            <option value="3">★★★☆☆</option>
                            <option value="4">★★★★☆</option>
                            <option value="5">★★★★★</option>
                        </select>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="adequacy" class="col-md-4 col-form-label text-md-right">充実度</label>
                                        <div class="col-md-6">
                                            <select name="review[adequacy]">
                                <option value="1">★☆☆☆☆</option>
                                <option value="2">★★☆☆☆</option>
                                <option value="3">★★★☆☆</option>
                                <option value="4">★★★★☆</option>
                                <option value="5">★★★★★</option>
                        </select>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="body" class="col-md-4 col-form-label text-md-right">本文</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" name="review[body]" placeholder="授業の詳細内容を入力してください。"></textarea>
                                            <p class="body__error" style="color:red">{{ $errors->first('review.body') }}</p>
                                        </div>
                                </div>
                                <div class="form-group row mb-0">
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