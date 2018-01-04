<?php

namespace App\Http\Controllers\Backoffice\Lists;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;use App\Models\Organization;

class IndexController extends Controller
{
	private $organization_id;

    function helper_loggedInOrganization(){
	   $key = Auth::id();
	   $o= Organization::where('auth_key_id', $key)->first();
       $this->organization_id = $o->id;
   }

    public function index(){
    	$this->helper_loggedInOrganization();
        $children = DB::table('children')
                ->where([
                    ['children.organization_id', '=', $this->organization_id],
                ])->get(['children.id', 'children.name']);
        
        return view('list.index', compact('children'));
    }
    
}