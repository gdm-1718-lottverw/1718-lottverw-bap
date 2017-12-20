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
use Carbon\Carbon;

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
        
        if($user != null){
            // Check is password is valid.
            if (password_verify($request['password'], $user['password'])) {
                // Check if role is actually parent
                if($user->role['name'] == 'parent')
                {
                    // Check if credentials are active
                    if($user['expire_date'] > new Carbon()){
                        $token = [
                            'token' =>  JWTAuth::fromUser($user)
                        ];
                        return $token;
                    } 
                    else {
                        return 'Credentials are expired';
                    }
                } else {
                    return 'Invalid role';
                }
            } else {
                return 'Invalid password.';
            }
        } else {
            return 'user not found';
        }
    }
       
}
