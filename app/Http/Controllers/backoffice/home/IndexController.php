<?php

namespace App\Http\Controllers\Backoffice\Home;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Child;
use App\Models\Organization;
use App\Models\PlannedAttendance;
use App\Models\Log;

class IndexController extends Controller
{
    public function index(){
        $in = 
        DB::table('children')->join('planned_attendances', function($join){
            $join->on('children.id', '=', 'planned_attendances.child_id')
                ->where([
                    ['planned_attendances.date', '=', date("Y-m-d")],
                    ['planned_attendances.organization_id', '=', 1],
                    ['planned_attendances.in', '=', true],
                    ['planned_attendances.out', '=', false],
                ]);
        })
        ->whereExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('logs')
                  ->whereRaw('logs.child_id = children.id && logs.action_id = 1');
        })
        ->get();

        $out = 
        DB::table('children')->join('planned_attendances', function($join){
            $join->on('children.id', '=', 'planned_attendances.child_id')
                ->where([
                    ['planned_attendances.date', '=', date("Y-m-d")],
                    ['planned_attendances.organization_id', '=', 1],
                    ['planned_attendances.in', '=', true],
                    ['planned_attendances.out', '=', true],
                ]);
        })
        ->whereExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('logs')
                  ->whereRaw('logs.child_id = children.id && logs.action_id = 2');
        })
        ->get();
        
        $toCome = 
        DB::table('children')->join('planned_attendances', function($join){
            $join->on('children.id', '=', 'planned_attendances.child_id')
                ->where([
                    ['planned_attendances.date', '=', date("Y-m-d")],
                    ['planned_attendances.organization_id', '=', 1],
                    ['planned_attendances.in', '=', false],
                ]);
        })
        ->get();
        
        return view('home.index', compact(['toCome', 'in', 'out']));
    }    

    public function signIn(request $request){
        $childId = $request->id;
        $child = \App\Models\PlannedAttendance::where(
            ['child_id' => $childId, 'date' => date("Y-m-d")]
        )->first();
        $child->in = true;
        $child->save();

        $log = new \App\Models\Log;
        $log->child_id = $child->child_id;
        $log->organization_id = $child->organization_id;
        $log->action_time = date('H:i:s');
        $log->deleted_at = NULL;
        $log->action_id = 1;
        $log->save();
        
        $in = 
        DB::table('children')->join('planned_attendances', function($join){
            $join->on('children.id', '=', 'planned_attendances.child_id')
                ->where([
                    ['planned_attendances.date', '=', date("Y-m-d")],
                    ['planned_attendances.organization_id', '=', 1],
                    ['planned_attendances.in', '=', true],
                ]);
        })
        ->whereExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('logs')
                  ->whereRaw('logs.child_id = children.id && logs.action_id = 1');
        })
        ->get();

        return view('home.partials.in', compact('in'));

    }    

    public function signOut(request $request){
        $childId = $request->id;

        $childId = $request->id;
        $child = \App\Models\PlannedAttendance::where(
            ['child_id' => $childId, 'date' => date("Y-m-d")]
        )->first();
        $child->out = true;
        $child->save();

        $log = new \App\Models\Log;
        $log->child_id = $child->child_id;
        $log->organization_id = $child->organization_id;
        $log->action_time = date('H:i:s');
        $log->action_id = 2;
        $log->save();

        $in = 
        DB::table('children')->join('planned_attendances', function($join){
            $join->on('children.id', '=', 'planned_attendances.child_id')
                ->where([
                    ['planned_attendances.date', '=', date("Y-m-d")],
                    ['planned_attendances.organization_id', '=', 1],
                    ['planned_attendances.in', '=', true],
                    ['planned_attendances.out', '=', false],
                ]);
        })
        ->whereExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('logs')
                  ->whereRaw('logs.child_id = children.id && logs.action_id = 1');
        })
        ->get();

        $out = 
        DB::table('children')->join('planned_attendances', function($join){
            $join->on('children.id', '=', 'planned_attendances.child_id')
                ->where([
                    ['planned_attendances.date', '=', date("Y-m-d")],
                    ['planned_attendances.organization_id', '=', 1],
                    ['planned_attendances.in', '=', true],
                    ['planned_attendances.out', '=', true],
                ]);
        })
        ->whereExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('logs')
                  ->whereRaw('logs.child_id = children.id && logs.action_id = 2');
        })
        ->get();
        
        $toCome = 
        DB::table('children')->join('planned_attendances', function($join){
            $join->on('children.id', '=', 'planned_attendances.child_id')
                ->where([
                    ['planned_attendances.date', '=', date("Y-m-d")],
                    ['planned_attendances.organization_id', '=', 1],
                    ['planned_attendances.in', '=', false],
                ]);
        })
        ->get();
        

    }    
}


