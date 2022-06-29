<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class SocialLoginController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver("$provider")->redirect();
    }
    
    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver("$provider")->user();
        } 
        catch (\Exception $e) {
            return redirect('/login')->with('oauth_error', 'ログインに失敗しました');
            // エラーならログイン画面へ転送
        }
        
        if($provider === "google"){
            $myinfo = User::firstOrCreate(['provider_id' => $user->id],
                ['name' => $user->name, 'email' => $user->email, 'email_verified_at' => now() ]);
                Auth::login($myinfo, true);
                return redirect()->to('/'); // トップページへ転送
        }
    }
}
