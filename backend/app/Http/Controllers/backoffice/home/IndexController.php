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
use App\Models\Guardian;
use App\Models\Action;
use Carbon\Carbon;

use App\Http\Helpers;

class IndexController extends Controller
{
    private $type; private $type_inverse; private $organization_id;

    public function index(){
        // Check the time.
        $types = helper_CheckTime();
        $this->type_inverse = $types->type_inverse;
        $this->type = $types->type;

        $this->organization_id = helper_loggedInOrganization();
        $general_conditions = [
            'organization_id' => $this->organization_id, 
            'date' => Carbon::today()
        ];
        $type_conditions_leftover = [
            'type' => [$this->type_inverse]
        ];

        $children = Child::where('organization_id', $this->organization_id)->get(['name', 'id']);
        
        $leftOver = [];
        if($this->type == "namiddag"){
            $leftOver = Child::general($general_conditions)
            ->where('pa.out', false)
            ->type($type_conditions_leftover)
            ->groupBy('pa.id')
            ->orderBy('children.name')
            ->get([
                'children.name',
                'children.date_of_birth', 
                'children.potty_trained',
                'children.pictures', 
                'children.id as child_id',
                'pa.id', 
                'pa.parent_notes', 
                 'pa.created_at', 
                'pa.in', 
                'pa.type', 
                'pa.out',]);
        }

        $in = Child::general($general_conditions)
            ->logs('in')
            ->presence('present_present')
            ->type(array("type" => [$this->type]))
            ->guards()
            ->groupBy('pa.id')
            ->orderBy('children.name')
            ->get([
                'children.name',
                'children.date_of_birth', 
                'children.potty_trained',
                'children.pictures', 
                'children.id as child_id',
                'pa.id', 
                'pa.parent_notes', 
                 'pa.created_at', 
                'pa.in', 
                'pa.type',
                'pa.guardian_id', 
                'g.name as guard', 
                'pa.out']);

        $out = Child::general($general_conditions)
            ->presence('present_out')
            ->logs('out')
            ->type(array("type" => [$this->type]))
            ->guards()
            ->groupBy('pa.id')
            ->orderBy('children.name')
            ->get([
                'children.name',
                'children.date_of_birth', 
                'children.potty_trained',
                'children.pictures', 
                'children.id as child_id',
                'pa.id', 
                'pa.parent_notes', 
                'pa.created_at', 
                'pa.in', 
                'pa.type',
                'pa.guardian_id', 
                'g.name as guard', 
                'pa.out']);


        $toCome = Child::general($general_conditions)
            ->presence('present_registered')
            ->groupBy('children.name')
            ->type(array("type" => [$this->type]))
            ->guards()
            ->groupBy('pa.id')
            ->orderBy('children.name')
            ->get([
                'children.name',
                'children.date_of_birth', 
                'children.potty_trained',
                'children.pictures', 
                'children.id as child_id',
                'pa.id', 
                'pa.parent_notes',
                'pa.created_at',  
                'pa.in', 
                'pa.type',
                'pa.guardian_id', 
                'g.name as guard', 
                'pa.out']);
        $count = Count($in);
        return view('home.index', compact(['toCome', 'in', 'out', 'leftOver', 'children', 'count']));
    }    

    public function signIn(request $request){
        // GET TYPE AND ORGANIZATION
        $types = helper_CheckTime();
        $this->type_inverse = $types->type_inverse;
        $this->type = $types->type;
        
        $this->organization_id = helper_loggedInOrganization();
        // UPDATE PLANNED ATTENDANXE
        $child = helper_SaveChild('in', $request->id, $this->type);
        // SAVE NEW LOG
        helper_NewLog($request->id, 'in', $this->organization_id);
        // DEFINE GENERAL CONDITIONS
        $general_conditions = [
            'organization_id' => $this->organization_id, 
            'date' => Carbon::today(),
        ];
        $type_conditions = [
            'type' => [$this->type]
        ];

        $in = Child::general($general_conditions)
            ->presence('present_present')
            ->type($type_conditions)
            ->logs('in')
            ->guards()
            ->groupBy('pa.id')
            ->orderBy('children.name')
            ->get([
                'children.name',
                'children.date_of_birth', 
                'children.potty_trained',
                'children.pictures', 
                'children.id as child_id',
                'pa.id', 
                'pa.parent_notes', 
                'pa.in', 
                'pa.type',
                'pa.created_at', 
                'pa.guardian_id', 
                'g.name as guard', 
                'pa.out']);

        $count = Count($in);
        return view('home.partials.in', compact('in', 'count'));
    }    

    public function signOut(request $request){
        // GET TYPE AND ORGANIZATION
        $types = helper_CheckTime();
        $this->type_inverse = $types->type_inverse;
        $this->type = $types->type;

        $this->organization_id = helper_loggedInOrganization();
        $child = helper_SaveChild('out', $request->id, $this->type);
        helper_NewLog($request->id, 'out', $this->organization_id);
    
        $general_conditions = [
            'organization_id' => $this->organization_id, 
            'date' => Carbon::today()
        ];
        $type_conditions = [
            'type' => [$this->type]
        ];

        $out = Child::general($general_conditions)
            ->presence('present_out')
            ->type($type_conditions)
            ->logs('out')
            ->guards()
            ->groupBy('pa.id')
            ->orderBy('children.name')
            ->get([
                'children.name',
                'children.date_of_birth', 
                'children.potty_trained',
                'children.pictures', 
                'children.id as child_id',
                'pa.id', 
                'pa.parent_notes', 
                'pa.created_at', 
                'pa.in', 
                'pa.type',
                'pa.guardian_id', 
                'g.name as guard', 
                'pa.out']);
       
       return view('home.partials.out', compact('out'));
    }   

    public function leftOverIn(request $request) {
        // GET TYPE AND ORGANIZATION
        $types = helper_CheckTime();
        $this->type_inverse = $types->type_inverse;
        $this->type = $types->type;

        $this->organization_id = helper_loggedInOrganization();
        $child = helper_SaveChild('in', $request->id, $this->type_inverse);
        helper_NewLog($request->id, 'in', $this->organization_id);

        $general_conditions = [
            'organization_id' => $this->organization_id, 
            'date' => Carbon::today()
        ];
        $type_conditions_leftover = [
            'type' => [$this->type_inverse]
        ];

        $leftOver = Child::general($general_conditions)
            ->type($type_conditions_leftover)
            ->guards()
            ->groupBy('pa.id')
            ->orderBy('children.name')
            ->get([
                'children.name',
                'children.date_of_birth', 
                'children.potty_trained',
                'children.pictures', 
                'children.id as child_id',
                'pa.id', 
                'pa.parent_notes',
                'pa.created_at',  
                'pa.in', 
                'pa.type',
                'pa.guardian_id', 
                'g.name as guard', 
                'pa.out']);
        
        return view('home.partials.leftOvers', compact('leftOver'));

    }
    public function leftOverOut(request $request) {
        // GET TYPE AND ORGANIZATION
        $types = helper_CheckTime();
        $this->type_inverse = $types->type_inverse;
        $this->type = $types->type;

        $this->organization_id = helper_loggedInOrganization();
        $child = helper_SaveChild('out', $request->id, $this->type_inverse);
        helper_NewLog($request->id, 'out', $this->organization_id);

        $general_conditions = [
            'organization_id' => $this->organization_id, 
            'date' => Carbon::today()
        ];
        $type_conditions_leftover = [
            'type' => [$this->type_inverse]
        ];

        $leftOver = Child::general($general_conditions)
            ->type($type_conditions_leftover)
            ->guards()
            ->groupBy('pa.id')
            ->orderBy('children.name')
            ->get([
                'children.name',
                'children.date_of_birth', 
                'children.potty_trained',
                'children.pictures', 
                'children.id as child_id',
                'pa.id', 
                'pa.parent_notes', 
                'pa.in', 
                'pa.type',
                'pa.guardian_id', 
                'pa.created_at', 
                'g.name as guard', 
                'pa.out']);

        return view('home.partials.leftOvers', compact('leftOver'));
    }

    public function storeChild(request $request){
        // request = data
        $data = $request;
        // Get the or_id
        $this->organization_id = helper_loggedInOrganization();
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
        helper_NewLog($pa->id, 'in', $this->organization_id);

        
        return redirect()->route('home');
    }

    /**
     * Soft delete.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request)
    {   
        $pa = PlannedAttendance::where('id', $request['_id'])->first();
        $pa->deleted_at = Carbon::now();
        $pa->save();

        $log = Log::where(
            [
                ['planned_attendance_id', '=' ,$request['_id']],
                ['created_at', '=' , $pa->created_at],
                ['deleted_at', '=' , null],
            ])->first();

        if($log != null ){
            $log->deleted_at = Carbon::now();
            $log->save();
        }        

        return redirect()->route('home');
    }
}


