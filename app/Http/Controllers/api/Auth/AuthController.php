<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWT;
use Tymon\JWTAuth\JWTGuard;
use App\Models\AuthKey;
class AuthController extends Controller
{
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        // Take the credentials
        $user = AuthKey::where('username', '=', $request['username'])->first();
        // Check is password is valid.
        if (password_verify($request['password'], $user['password'])) {
            $token = JWTAuth::fromUser($user);
    
            return $token;

        } else {
            return 'Invalid password.';
        }
       

       
    }
}
