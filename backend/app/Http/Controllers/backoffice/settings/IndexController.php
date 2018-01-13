<?php

namespace App\Http\Controllers\Backoffice\Settings;

use Carbon\Carbon;
use App\Models\Organization;
use App\Models\Vacation;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    	$vacations = Vacation::where([['organization_id', $this->organization_id], ['deleted_at', null]])->orderBy('day', 'ASC')->get();

        return view('settings.index', compact(['vacations']));
    }
    
}
