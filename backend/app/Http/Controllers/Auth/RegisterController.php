<?php

namespace App\Http\Controllers\Auth;

use App\Models\Organization;
use App\Models\AuthKey;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:auth_keys',
            'email' => 'required|string|email|max:255|unique:organizations',
            'phone' => 'required|string|max:60',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\AuthKey
     */
    protected function create(array $data)
    {
        $role = Role::where('name', 'organization')->first();
        $key = AuthKey::create([
            'username' => $data['username'],
            'role_id' => $role->id,
            'expire_date' => Carbon::now()->addYear(1),
            'password' => bcrypt($data['password']),
        ]);
        $organization = new Organization;
        $organization->auth_key_id = $key->id;
        $organization->name = $data['name'];
        $organization->email = $data['email'];
        $organization->phone = $data['phone'];
        $organization->save();

        return $key;
    }
}
