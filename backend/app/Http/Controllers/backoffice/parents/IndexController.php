<?php

namespace App\Http\Controllers\Backoffice\Parents;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\AuthKey;
use App\Models\Organization;
use App\Models\Parents;
use App\Models\Role;

use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller; 

class IndexController extends Controller
{
    private $organization_id;

    function helper_loggedInOrganization(){
        $key = Auth::id();
        $o= Organization::where('auth_key_id', $key)->first();
        $this->organization_id = $o->id;  
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('parents.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validatedData = $request->validate([
            'username' => 'required|string|unique:auth_keys|max:255',
            'password' => 'required|string|min:6|confirmed',
            'family_type' => 'required|string',
            'parent_1_name' => 'required|string',
            'parent_1_relation' => 'required|string',
            'parent_1_email' => 'required|email|max:255',
            'parent_1_phone_number' => 'required|string|max:60',
            'parent_2_name' => 'string',
            'parent_2_relation' => 'string',
            'parent_2_email' => 'email|max:255',
            'parent_2_phone_number' => 'string|max:60',
        ]);
         
        $role = Role::where('name', 'parent')->first();
        $key = new AuthKey;
            $key->role_id = $role->id;
            $key->expire_date = Carbon::now()->addYear(1);
            $key->username = $request->username;
            $key->password = bcrypt($request->password);
        $key->save(); 

        $parent = new Parents;
        $parent->name = $request->parent_1_name;
        $parent->email = $request->parent_1_email;
        $parent->relation = $request->parent_1_relation;
        $parent->phone_number = $request->parent_1_phone_number;
        $parent->auth_key_id = $key->id;
        $parent->family_type = $request->family_type;
        $parent->save();
        // check if there are multiple parents
        $parentCount = $request->family_type == "alleenstaande ouder"? 1 : 2;
        echo $parentCount;
        if($parentCount == 2){
            $parent2 = new Parents;
            $parent2->name = $request->parent_2_name;
            $parent2->email = $request->parent_2_email;
            $parent2->relation = $request->parent_2_relation;
            $parent2->phone_number = $request->parent_2_phone_number;
            $parent2->auth_key_id = $key->id;
            $parent2->family_type = $request->family_type;
            $parent2->save();
        }
        return redirect()->route('createChild', ['auth_key_id' => $key->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {       
        //
    }
    
    /**
     * Soft delete a record
     *
     * @param  int  $id
     */
    public function delete($id)
    {
       //
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
