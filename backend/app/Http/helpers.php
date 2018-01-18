<?php


use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Organization;
use App\Models\Log;
use App\Models\Action;
use App\Models\PlannedAttendance;

use Carbon\Carbon;

if (! function_exists('helper_loggedInOrganization')) {
	function helper_loggedInOrganization(){
        $key = Auth::id();
	    $o = Organization::where('auth_key_id', $key)->first();
        return $o->id;
   }
};

if (! function_exists('helper_CheckTime')) {
 	function helper_CheckTime(){
        Carbon::setlocale(LC_TIME, 'German');
        $now = Carbon::now()->format('H:i:s');   
        $middag  = Carbon::create(2017, 12, 23, 12, 01, 00)->format('H:i:s');
        if($now < $middag){
          	return (object) array('type' => 'voormiddag', 'type_inverse' =>'namiddag');

        } else {
            return (object) array('type' => 'namiddag', 'type_inverse' =>'voormiddag');
        }
    }
}

if (! function_exists('helper_SaveChild')) {
function helper_SaveChild(string $action, int $id, string $type){
        $child = PlannedAttendance::find($id);
        $child->$action = true;
        $child->save();
        return $child;
    }
}
if (! function_exists('helper_NewLog')) {
 function helper_NewLog($attendance, $action, $or_id){
        $action = Action::where('name', $action)->first();
        $log = new Log;
        $log->planned_attendance_id = $attendance;
        $log->organization_id = $or_id;
        $log->action_time = date('H:i:s');
        $log->deleted_at = NULL;
        $log->action_id = $action->id;
        $log->save();
    }
}
