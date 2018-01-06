<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Closure;
use App\Models\Parents;
use App\Models\AuthKey; 
use JWTAuth;
use Carbon\Carbon;
class CheckForCredentials
{
    private $id;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

     /**
      * 
      * TODO aparte middelware. voor meerdere zoekopdrachten. 
      */
    public function handle($request, Closure $next)
    {   
        // Get the authorization header.
        $string = $request->header('Authorization');
        // Shorten it.
        $token = substr($string, 7);
        // set the token so we can decode it later.
        JWTAuth::setToken($token);
        // Get the token again. 
        $token = JWTAuth::getToken();
        // Decode the token
        $decode = JWTAuth::decode($token)->toArray();
        // Get the auth key id from the token. aka. user identification. 
        $count = 0;
        foreach($decode as $d){
            if($count == 0){
                $this->id = $d;   
            }
            $count++;
        }
        // Get route parameters.
        $parameters = $request->route()->parameters();
        $keys = array_keys($parameters);
        // For every route parameter check the following.
        foreach( $keys as $key){
            if($key == 'parent_id'){
                $parents = Parents::where('auth_key_id', $this->id)->first();
                // Check if parent id is actually the parent_id given in the token. 
                if($request->route('parent_id') == $parents->id){
                    // check the role of the user.
                    $key = AuthKey::where('id', '=', $this->id)->first();
                    // check if key is expired.
                    if($key->expire_date < new Carbon()){
                         abort(403, 'Key expired'); 
                    }
                    // check if role is parent.
                    if($key->role->name == 'parent'){
                        return $next($request);
                    } 
                    else { 
                        abort(403, 'Incorrect role'); 
                    } 
                } else {
                    abort(403, 'Unauthorized action.');
                }
            }
        }
    }
}

