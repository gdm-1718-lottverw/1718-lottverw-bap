<?php

namespace App\Http\Controllers\Backoffice\Home;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Child;
use App\Models\Organization;
use App\Models\PlannedAttendance;
use App\Models\Log;
use App\Models\Action;
use Carbon\Carbon;

class IndexController extends Controller
{
    private $type; private $type_inverse; private $organization_id;

    function helper_CheckTime(){
       // echo Carbon::now()->format('H:i:s');
        $now = Carbon::now()->format('H:i:s'); 
        $middag  = Carbon::create(2017, 12, 23, 12, 01, 00)->format('H:i:s');
    
        if($now < $middag){
            $this->type = 'voormiddag';
            $this->type_inverse = 'namiddag';
        } else {
            $this->type = 'namiddag';
            $this->type_inverse = 'voormiddag';
        }
    }

    function helper_SaveChild(string $action, int $id){
        $child = PlannedAttendance::where(
            ['child_id' => $id, 'date' => date("Y-m-d")]
        )->first();
        $child->$action = true;
        $child->save();

        return $child;
    }

    function helper_loggedInOrganization(){
        $key = Auth::id();
        $o= Organization::where('auth_key_id', $key)->first();
        $this->organization_id = $o->id;
    }
    
    function helper_NewLog($child, $action){
        $action = Action::where('name', $action)->first();

        $log = new Log;
        $log->child_id = $child->child_id;
        $log->organization_id = $this->organization_id;
        $log->action_time = date('H:i:s');
        $log->deleted_at = NULL;
        $log->action_id = $action->id;
        $log->save();
    }

    public function index(){
        // Check the time.
        $this->helper_CheckTime();
        $this->helper_loggedInOrganization();
        
        $general_conditions = [
            'organization_id' => $this->organization_id, 
            'date' => Carbon::today()
        ];
        $type_conditions_leftover = [
            'type' => [$this->type_inverse]
        ];

        $type_conditions = [
            'type' => [$this->type, 'hele dag']
        ];

        $children = Child::where('organization_id', $this->organization_id)->get(['name', 'id']);
        
        $leftOver = Child::general($general_conditions)
            ->presence('present_registered')
            ->type($type_conditions_leftover)
            ->get();

        $in = Child::whereHas('logs.actions', function($query){
                $query->where('actions.name','=', 'in');
            })
            ->general($general_conditions)
            ->presence('present_present')
            ->type($type_conditions)
            ->get();

        $out = Child::whereHas('logs.actions', function($query){
                $query->where('actions.name','=', 'out');
            })
            ->general($general_conditions)
            ->presence('present_out')
            ->type($type_conditions)
            ->get();

        $toCome = Child::general($general_conditions)
            ->presence('present_registered')
            ->type($type_conditions)
            ->get();


        return view('home.index', compact(['toCome', 'in', 'out', 'leftOver', 'children']));
    }    

    public function signIn(request $request){
        $this->helper_loggedInOrganization();
        // UPDATE CHILD
        $child = $this->helper_SaveChild('in', $request->id);
        // SAVE NEW LOG
        $this->helper_NewLog($child, 'in');
        // DEFINE GENERAL CONDITIONS
        $general_conditions = [
            'organization_id' => $this->organization_id, 
            'date' => Carbon::today()
        ];
        $type_conditions = [
            'type' => [$this->type, 'hele dag']
        ];

        $in = Child::whereHas('logs.actions', function($query){
                    $query->where('actions.name','=', 'in');
            })
            ->general($general_conditions)
            ->presence('present_present')
            ->type($type_conditions)
            ->get();


        return view('home.partials.in', compact('in'));
    }    

    public function signOut(request $request){
        $this->helper_loggedInOrganization();
        $child = $this->helper_SaveChild('out', $request->id);
        $this->helper_NewLog($child, 'out');
        
        
        $general_conditions = [
            'organization_id' => $this->organization_id, 
            'date' => Carbon::today()
        ];
        $type_conditions = [
            'type' => [$this->type, 'hele dag']
        ];
        $out = Child::whereHas('logs.actions', function($query){
                $query->where('actions.name','=', 'out');
            })
            ->general($general_conditions)
            ->presence('present_out')
            ->type($type_conditions)
            ->get();

       return view('home.partials.out', compact('out'));
    }    

    public function storeChild(request $request){
        // request = data
        $data = $request;
        // Get the or_id
        $this->helper_loggedInOrganization();   
        // New Entry
        $pa = new PlannedAttendance;
        $pa->organization_id = $this->organization_id;
        $pa->date = Carbon::now()->format('Y-m-d'); 
        $pa->out = false;
        $pa->in = $data['_in'];
        $pa->type = $data['type'];
        $pa->child_id = $data['child_id'];
        $pa->save();
        // New log entry
        $this->helper_NewLog($data, 'in');

        
        return redirect()->route('home');
    }
}


