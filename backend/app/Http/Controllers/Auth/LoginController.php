<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use Illuminate\Http\Request;
use Carbon\Carbon;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
//    use AuthenticatesUsers;

    /**
    * return login view.
    */
    public function index(){
        return view('auth.login');
    }
    
    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {   
        $this->validate($request, [
            'username' => 'required',
            'password'  => 'required'
        ]);
    
        // Check is password is valid.
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
            $role = Role::where([['name','=', 'organization'], ['active','=', true]])->first();
            $user = Auth::user();
            // Check if role is actually parent
            if($user->role_id == $role->id)
            {
                // Check if this was the first login.
                if($user->last_login == null){
                    $user->first_login = new Carbon();
                }
                $user->last_login = new Carbon();
                $user->save();
                // redirect
                return redirect()->intended('/');
            } 
            else {
                abort(403, 'Invalid role'); 
            } 
        } else {
            abort(403, 'User not found'); 
        }
    }
     /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function logout(Request $request)
    {   
        Auth::logout();
        return redirect()->intended('login');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
