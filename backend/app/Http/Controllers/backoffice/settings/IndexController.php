<?php

namespace App\Http\Controllers\Backoffice\Settings;

use Carbon\Carbon;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{

    private $date = "";  private $organization_id;

    function helper_loggedInOrganization(){
        $key = Auth::id();
        $o= Organization::where('auth_key_id', $key)->first();
        $this->organization_id = $o->id;  
    }

    public function index(){
        return view('settings.index');
    }
    
}
