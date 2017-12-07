<?php

namespace App\Http\Controllers\Backoffice\Home;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Child;
use App\Models\Organization;
use App\Models\PlannedAttendance;

class IndexController extends Controller
{
    public function index(){
        $toCome = DB::table('children')
        ->join('planned_attendances', function ($join) {
            $join->on('children.id', '=', 'planned_attendances.child_id')
                ->where([
                        ['planned_attendances.date', '=', date("Y-m-d")],
                        ['planned_attendances.organization_id', '=', 1],
                        ['planned_attendances.in', '=', false],
                        ['planned_attendances.out', '=', false]
                    ]);
        })->get();
        $in = DB::table('children')
        ->join('planned_attendances', function ($join) {
            $join->on('children.id', '=', 'planned_attendances.child_id')
                ->where([
                        ['planned_attendances.date', '=', date("Y-m-d")],
                        ['planned_attendances.organization_id', '=', 1],
                        ['planned_attendances.in', '=', true],
                        ['planned_attendances.out', '=', false]
                    ]);
        })->get();
        $out = DB::table('children')
        ->join('planned_attendances', function ($join) {
            $join->on('children.id', '=', 'planned_attendances.child_id')
                ->where([
                        ['planned_attendances.date', '=', date("Y-m-d")],
                        ['planned_attendances.organization_id', '=', 1],
                        ['planned_attendances.in', '=', true],
                        ['planned_attendances.out', '=', true]
                    ]);
        })->get();

        return view('home.index', compact(['toCome', 'in', 'out']));
    }    

    public function signIn(request $request){
        $childId = $request->id;
        $child = \App\Models\PlannedAttendance::where(
            ['child_id' => $childId, 
            'date' => date("Y-m-d")]
        )->first();
      
        $child->in = true;
        $child->time_in = date("Y-m-d H:i:s");
        $child->save();
        
        $in = DB::table('children')
        ->join('planned_attendances', function ($join) {
            $join->on('children.id', '=', 'planned_attendances.child_id')
                ->where([
                        ['planned_attendances.date', '=', date("Y-m-d")],
                        ['planned_attendances.organization_id', '=', 1],
                        ['planned_attendances.in', '=', true],
                        ['planned_attendances.out', '=', false]
                    ]);
        })->get();
        return view('home.partials.in', compact('in'));

    }    

    public function signOut(request $request){
        $childId = $request->id;
        $child = \App\Models\PlannedAttendance::where(
            ['child_id' => $childId, 
            'date' => date("Y-m-d")]
        )->first();
      
        $child->out = true;
        $child->pickup_time = date("Y-m-d H:i:s");
        $child->save();
        
        $toCome = DB::table('children')
        ->join('planned_attendances', function ($join) {
            $join->on('children.id', '=', 'planned_attendances.child_id')
                ->where([
                        ['planned_attendances.date', '=', date("Y-m-d")],
                        ['planned_attendances.organization_id', '=', 1],
                        ['planned_attendances.in', '=', false],
                        ['planned_attendances.out', '=', false]
                    ]);
        })->get();
        $in = DB::table('children')
        ->join('planned_attendances', function ($join) {
            $join->on('children.id', '=', 'planned_attendances.child_id')
                ->where([
                        ['planned_attendances.date', '=', date("Y-m-d")],
                        ['planned_attendances.organization_id', '=', 1],
                        ['planned_attendances.in', '=', true],
                        ['planned_attendances.out', '=', false]
                    ]);
        })->get();
        $out = DB::table('children')
        ->join('planned_attendances', function ($join) {
            $join->on('children.id', '=', 'planned_attendances.child_id')
                ->where([
                        ['planned_attendances.date', '=', date("Y-m-d")],
                        ['planned_attendances.organization_id', '=', 1],
                        ['planned_attendances.in', '=', true],
                        ['planned_attendances.out', '=', true]
                    ]);
        })->get();

    }    
}


