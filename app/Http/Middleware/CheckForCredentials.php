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
    public function handle($request, Closure $next)
    {   
        $string = $request->header('Authorization');
        $token = substr($string, 7);
        JWTAuth::setToken($token);
        $token = JWTAuth::getToken();
        $decode = JWTAuth::decode($token)->toArray();
        $count = 0;
        foreach($decode as $d){
            if($count == 0){
                $this->id = $d;   
            }
            $count++;
        }
        $parameters = $request->route()->parameters();
        $keys = array_keys($parameters);
        foreach( $keys as $key){
            if($key == 'parent_id'){
                // Check if parent id is actually the parent_id given in the token. 
                if($request->route('parent_id') == $this->id){
                    // check the role of the user.
                    $key = AuthKey::where('id', '=', $this->id)->first();
                    // check if key is expired.
                    if($key->expire_date < new Carbon()){
                         abort(403, 'Key expired'); 
                    }
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
        // check if child id is given
        // if child id is given check if parent is actually the parent of the child.
    }
}

