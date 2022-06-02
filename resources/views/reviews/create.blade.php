<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>レビュー投稿</title>
    </head>
@extends('layouts.app')

@section('content')
    <body>
        <h1>新規投稿</h1>
            <form action="/reviews" method="POST">
                @csrf
                    <div class="title">
                        <h2>科目名</h2>
                        <input type="text" name="review[title]" placeholder="科目名"/>
                    </div>
                    <div class="get_credit">
                        <h2>単位取得度</h2>
                        <select name="review[get_credit]">
                            <option value="1">★☆☆☆☆</option>
                            <option value="2">★★☆☆☆</option>
                            <option value="3">★★★☆☆</option>
                            <option value="4">★★★★☆</option>
                            <option value="5">★★★★★</option>
                        </select>
                    </div>
                    <div class="adequacy">
                        <h2>充実度</h2>
                        <select name="review[adequacy]">
                                <option value="1">★☆☆☆☆</option>
                                <option value="2">★★☆☆☆</option>
                                <option value="3">★★★☆☆</option>
                                <option value="4">★★★★☆</option>
                                <option value="5">★★★★★</option>
                        </select>
                    </div>
                    <div class="body">
                        <h2>本文</h2>
                        <textarea name="review[body]" placeholder="授業の詳細内容を入力してください。"></textarea>
                    </div>
                <input type="submit" value="保存"/>
            </form>
        <div class="back">[<a href="/">戻る</a>]</div>
    </body>
@endsection
</html>