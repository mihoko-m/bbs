<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Faculty;
use App\User;
use App\Review;

class UserController extends Controller
{
    public function mypage(User $user, Review $review)
    {
        return view('users/mypage')->with(['user' => $user])->with(['reviews' => $user->getByUser()]);
    }
    
    public function edit(User $user, Faculty $faculty)
    {
        return view('users/edit')->with(['user' => $user])->with(['faculties' => $faculty->get()]);    
    }
    
    public function update(User $user, UserRequest $request)
    {
        if(\Auth::user()->id == $user->id){
            $input_user = $request['user'];
            $user->fill($input_user)->save();

            return redirect('/users/' . $user->id . '/mypage');
        }else{
            abort(403, '権限がありません');
        }
    }
}
