<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>プロフィール編集</title>
    </head>
@extends('layouts.app')

@section('content')
    <body>
        <div class="container">
            <div class="card">
                <div class="card-header">プロフィール編集</div>
                    <form action="/users/{{ $user->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="title" class="col-md-4 col-form-label text-md-right">名前</label>
                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="user[name]" value="{{ $user->name }}" required autocomplete="name" autofocus>
                                            
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="image_path" class="col-md-4 col-form-label text-md-right">プロフィール画像</label>
                                        <div class="col-md-6">
                                            <input type="file" name="image">
                                            <p class="image__error" style="color:red">{{ $errors->first('image') }}</p>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="faculty" class="col-md-4 col-form-label text-md-right">所属学部・学科名</label>
                                        <div class="col-md-6">
                                            <select name="user[faculty_id]">
                                                @if(!isset( $user->faculty ))
                                                    @foreach($faculties as $faculty)
                                                        <option value="{{ $faculty->id }}">{{ $faculty->name }} {{ $faculty->department_name }}</option>
                                                    @endforeach
                                                @else
                                                    @foreach($faculties as $faculty)
                                                        @if( $faculty->id === $user->faculty->id )
                                                           <option value="{{ $faculty->id }}" selected>{{ $faculty->name }} {{ $faculty->department_name }}</option>
                                                        @else
                                                            <option value="{{ $faculty->id }}">{{ $faculty->name }} {{ $faculty->department_name }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                                <p class="faculty__error" style="color:red">{{ $errors->first('user.faculty_id') }}</p>
                                            </select>
                                        </div> 
                                </div>
                                <div class="form-group row">
                                    <label for="body" class="col-md-4 col-form-label text-md-right">プロフィール</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" name="user[profile]" placeholder="300文字以内で入力してください。">{{ $user->profile }}</textarea>
                                            <p class="body__error" style="color:red">{{ $errors->first('user.profile') }}</p>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-8 offset-md-4">
                                        <input type="submit" value="保存" class="btn btn-primary"/>
                                        <a class="btn btn-link" href="/users/{{Auth::user()->id}}">マイページに戻る</a>
                                    </div>
                                </div>
                            </div>
                    </form>
            </div>
        </div>
    </body>
@endsection
</html>