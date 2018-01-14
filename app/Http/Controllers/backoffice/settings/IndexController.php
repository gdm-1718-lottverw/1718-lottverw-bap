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

    public function store(Request $request){
    	$validatedData = $request->validate([
            'occasion' => 'required|string',
            'day' => 'required|date',
        ]);

        $this->helper_loggedInOrganization();
        $v = new Vacation;
        $v->occasion = $request->occasion;
        $v->organization_id = $this->organization_id;
        $v->day = Carbon::parse($request->day)->format('Y-m-d');
        $v->save();

        return redirect()->route('settings');
    }
    /**
     * Soft delete.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(request $request)
    {   
    	$v = Vacation::find($request->_sid);
        $v->deleted_at = Carbon::now();
        $v->save();

        return redirect()->route('settings');
    }
}
