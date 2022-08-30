<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Faculty;
use App\User;
use App\Review;
use Storage;

class UserController extends Controller
{
    public function show(User $user, Review $review)
    {
        return view('users/show')->with(['user' => $user])
        ->with(['reviews' => $user->getByUser()])
        ->with(['favorites' => $user->favorites()->get()]);
    }
    
    public function edit(User $user, Faculty $faculty)
    {
        return view('users/edit')->with(['user' => $user])->with(['faculties' => $faculty->get()]);    
    }
    
    public function update(User $user, UserRequest $request)
    {
        if(\Auth::user()->id == $user->id){
            $input_user = $request['user'];
            
            //s3アップロード開始
            $input_image = $request['image'];
            
            if (isset($input_image)) {
                // バケットの`users/`フォルダへアップロード
                $path = Storage::disk('s3')->putFile('users', $input_image, 'public');
                // アップロードした画像のフルパスを取得
                $input_user += ['image_path' => Storage::disk('s3')->url($path)];
            }
            
            $user->fill($input_user)->save();

            return redirect('/users/' . $user->id);
        }else{
            abort(403, '権限がありません');
        }
    }
}
