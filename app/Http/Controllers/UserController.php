<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faculty;
use App\User;
use App\Review;

class UserController extends Controller
{
    public function mypage(User $user, Review $review)
    {
        return view('users/mypage')->with(['user' => $user])->with(['reviews' => $user->getByUser()]);
    }
}
