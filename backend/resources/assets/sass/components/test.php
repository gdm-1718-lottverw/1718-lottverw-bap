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
        $children = Child::where('organization_id', 1)->get();
        $or = Organization::where('main_organization', 1)->get();

        return view('filter.index', compact(['or', 'children']));
    }
    
    public function create(request $request){
        $children = Child::where('organization_id', 2)->where('potty_trained', false)->get();
       
        $data = $request->data;
        
        echo "present_present: "  . array_search('present_present', $data);
        echo "present_registered: "  . array_search('present_registered', $data);
        echo "present_all: "  . array_search('present_all', $data);
        echo '</br>'. "------------" . '</br>' ;
        
        $this->date = $request->date;
        
            if(array_search('present_present', $data, true) < 1){
                echo "present_present: "  . array_search('present_present', $data);
                $children = DB::table('children')
                    ->join('planned_attendances', function ($join) {
                        $join->on('children.id', '=', 'planned_attendances.child_id')
                            ->where([
                                    ['planned_attendances.date', '=', $this->date], 
                                    ['planned_attendances.organization_id', '=', 1]
                                ]);
                    })->get();
                return view('filter.children', compact('children'));
            } 
            else if(array_search('present_registered', $data) == 0) {
                echo "present_registered: "  . array_search('present_registered', $data);
                $children = DB::table('children')->join('planned_attendances', function ($join) {
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
            else if (array_search('present_all', $data) == 0){
                echo "present_all: "  . array_search('present_all', $data);
                $children = Child::where('organization_id', 1)->get();
                return view('filter.children', compact('children'));
            } else {
                echo "laate: "  . array_search('present_all', $data);
                $children = Child::where('organization_id', 1)->get();
                return view('filter.children', compact('children'));
            }
            
       
    }
}
