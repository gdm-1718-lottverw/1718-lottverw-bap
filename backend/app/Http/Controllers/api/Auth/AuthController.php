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
use App\Models\Parents;
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
                        $token = JWTAuth::fromUser($user);
                        // Check if this was the first login.
                        if($user->last_login == null){
                            $user->first_login = new Carbon();
                        }
                        // Check if user wants to be remembered.
                        if($request['remember_me'] == true){
                            $user->remember_token = $token;
                        }
                        $user->last_login = new Carbon();
                        $user->save();

                        // return token and parent id for later use.  
                        $parent = Parents::where('auth_key_id', '=', $user->id)->first();
                       
                        $response = [
                            "token" => $token,
                            "parent" => $parent->id
                        ];
                        return $response;
                    } 
                    else {
                        abort(403, 'Credentials are expired'); 
                    }
                } else {
                    abort(403, 'Invalid role'); 
                }
            } else {
                abort(403, 'Invalid password'); 
            }
        } else {
            abort(403, 'User not found'); 
        }
    }
       
}
