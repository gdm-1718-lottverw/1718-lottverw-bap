<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use Illuminate\Http\Request;

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
        
        $role = Role::where([['name','=', 'organization'], ['active','=', true]])->first();
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
            if(Auth::user()->role_id == $role->id){
                return redirect()->intended('/');
            } else {
                abort(404, 'user not found');
            }  
        } else {
            abort(404, 'user not found');
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
