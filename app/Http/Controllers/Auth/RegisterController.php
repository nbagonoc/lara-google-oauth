<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use App\User;
use App\Oauth;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleProviderCallback()
    {
        try{
            $socialUser = Socialite::driver('google')->user();
        }
        catch(\Exception $e){
            return redirect('/');
        }
        $user = User::where('email', $socialUser->getEmail())->first();
        if(!$user){
            $user = User::firstOrCreate(
                ['email'=>$socialUser->getEmail()],
                ['name'=>$socialUser->getName()]
            );

            auth()->login($user);
            return redirect('/dashboard');

        } else {
            auth()->login($user);
            return redirect('/dashboard');
        }
    }

}
