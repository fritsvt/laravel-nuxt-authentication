<?php

namespace App\Http\Controllers\api\Auth;

use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\JWTAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SocialLoginController extends Controller
{
    protected $auth;

    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
        $this->middleware(['guest', 'web', 'socialj']);
    }

    public function redirect($service, Request $request)
    {
        return Socialite::driver($service)->redirect();
    }

    public function callback($service, Request $request)
    {
        $serviceUser = Socialite::driver($service)->user();
        dd($serviceUser);
    }
}