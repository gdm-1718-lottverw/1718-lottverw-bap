<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Child;
use App\Models\Organization;
use App\Models\PlannedAttendance;

class FilterController extends Controller
{
    private $date = "";

    public function index(){
        /**
         * Select all present children from the database.
         */
        $children = DB::table('children')
        ->join('planned_attendances', function ($join) {
            $join->on('children.id', '=', 'planned_attendances.child_id')
                ->where([
                        ['planned_attendances.date', '=', date("Y-m-d")],
                        ['planned_attendances.organization_id', '=', 1]
                    ]);
        })->get();
        $or = Organization::where('main_organization', 1)->get();

        return view('filter.index', compact(['or', 'children']));
    }
    
    public function create(request $request){       
        $data = $request->data; $this->date = $request->date;
        if(array_search('present_present', $data, true) === 0){
            $children = DB::table('children')
                ->join('planned_attendances', function ($join) {
                    $join->on('children.id', '=', 'planned_attendances.child_id')
                        ->where([
                                ['planned_attendances.date', '=', $this->date], 
                                ['planned_attendances.organization_id', '=', 1],
                                ['planned_attendances.in', '=', true],
                                ['planned_attendances.out', '=', false]
                            ]);
                })->get();
            return view('filter.children', compact('children'));
        } 
        if(array_search('present_registered', $data, true) === 0) {
            $children = DB::table('children')->join('planned_attendances', function ($join) {
                $join->on('children.id', '=', 'planned_attendances.child_id')
                    ->where([
                            ['planned_attendances.date', '=', $this->date], 
                            ['planned_attendances.organization_id', '=', 1],
                        ]);
            })->get();
            
            return view('filter.children', compact('children'));
        }   
        if (array_search('present_all', $data, true) === 0){
            $children = Child::where('organization_id', 1)->get();
            return view('filter.children', compact('children'));
        } 
    }
}
