<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use Auth;
use Exception;
use App\User;
use App\Social;
use Carbon\Carbon;

class SocialLoginController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($social)
    {
        return Socialite::driver($social)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($social)
    {
        try {
            $online_user = Socialite::driver($social)->stateless()->user();
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Please login with another method');
        }
        // $ci = request()->input('state');
		$social_user = Social::where('social_id', $online_user->id)->where('social_name', $social)->first();
		
		if($social_user) {
		    $social_user->update([
                'name' => $online_user->name,
                'email' => $online_user->email,
                'avatar'=> $online_user->avatar,
            ]);
            
		    Auth::login($social_user->user, true);
		} else {
		    $user = User::where('email', $online_user->email)->first();
		    if($user) {
		        $online_user->user_id = $user->id;
		        $social_user = Social::create([
		                'social_id' => $online_user->id,
		                'social_name' => $social,
		                'name' => $online_user->name,
		                'email' => $online_user->email,
		                'avatar'=> $online_user->avatar,
		                'user_id' => $user->id,
		            ]);
		        Auth::login($social_user->user, true);
		    } else {
		        $password = str_random(10);
        		$user = User::create([
        			'name' => $online_user->name,
        			'email' => $online_user->email,
        			'password' => bcrypt($password),
        			'email_verified_at' => Carbon::now(),
        		]);
        		$online_user->user_id = $user->id;
        		$social_user = Social::create([
		                'social_id' => $online_user->id,
		                'social_name' => $social,
		                'name' => $online_user->name,
		                'email' => $online_user->email,
		                'avatar'=> $online_user->avatar,
		                'user_id' => $user->id,
		            ]);
		        Auth::login($social_user->user, true);
		    }
		}
// 		if(session('total'))
//             return redirect()->route('checkout');
        // Session::put('cookie_expiration', 60);
        // return view('frontend.client-id');
        // return redirect()->route('client-id.show', $ci);
        return redirect()->intended(route('dashboard'));
    }
}
