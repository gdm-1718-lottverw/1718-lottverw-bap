<?php

namespace App\Http\Controllers\API\Calendar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Child;
use App\Models\PlannedAttendance;
use App\Models\Parents;

use Carbon\Carbon;
class CalendarController extends Controller
{

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $children = Parents::with('children')->where('id', $id)->first()->children;
        $id = [];
       
        foreach($children as $child){
            array_push($id, $child->id);
        }

        $p = Child::whereIn('children.id', $id)->futureAttendance()->get(
            ['pa.date as date', 'children.name as child', 'pa.type as type', 'pa.id as id', 'pa.parent_notes as note']
        );
        return $p;
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, Request $request){
        foreach ($request->child_id as $child => $id) {
            $organization = Child::where('id', $id)->with('organization')->first()->organization;
            
            $plannedAttendance = new PlannedAttendance;
            $plannedAttendance->date = $request->date;
            $plannedAttendance->type = $request->type;
            $plannedAttendance->parent_notes = $request->parent_notes;
            $plannedAttendance->go_home_alone = $request->go_home_alone;
            $plannedAttendance->child_id = $id;
            $plannedAttendance->organization_id = $organization->id;
            $plannedAttendance->save();
        }
       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($parent_id, $pa_id){
            
        $plannedAttendance = PlannedAttendance::where('id', $pa_id)->first();
        $plannedAttendance->deleted_at = Carbon::now();
        $plannedAttendance->save();
        
        $children = Parents::with('children')->where('id', $parent_id)->first()->children;
        $id = [];
       
        foreach($children as $child){
            array_push($id, $child->id);
        }

        $p = Child::whereIn('children.id', $id)->futureAttendance()->get(
            ['pa.date as date', 'children.name as child', 'pa.type as type', 'pa.id as id']
        );
        return $p;
        
       
    }

}
