<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\Controller;
use App\Person;


use Socialite;

class AuthController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        if(env('USER_ID'))
        {
            $this->localLogin(env('USER_ID'));
            return Redirect::to('/');
        }
        else
        {
            return Socialite::driver('azure')->redirect();
        }
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('azure')->user();
        } catch (Exception $e) {
            return Redirect::to('/auth/azure');
        }

        $authUser = $this->findOrCreateUser($user);
        Auth::login($authUser, true);

        return Redirect::to('/');
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $githubUser
     * @return User
     */
    private function findOrCreateUser($azureUser)
    {
        $email = $azureUser->email;
        $authUser = Person::whereHas('contactinfo',function($q) use ($email) {$q->where('value', $email);})->get();
        dd($authUser);
        if ($authUser){
            return $authUser;
        }else{
            return Redirect::to('/');
        }
    }
    
    public function localLogin($id){
        $user = new \stdClass();
        $user->id = $id;
        $authUser = User::where('github_id', $user->id)->first();
        Auth::login($authUser, true);
    }
    
    public function logoutUser(){
        Auth::logout();
        return Redirect::to('/');
    }
}