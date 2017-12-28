<?php

namespace App\Http\Controllers\API\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Child;
use App\Models\PlannedAttendance;
use App\Models\Parents;


class ChildController extends Controller
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
           /* $p = Child::where('children.id', $child->id)->futureAttendance()->get(
                ['pa.date as date', 'children.name as name', 'pa.type as type']
            );*/
            array_push($id, $child->id);
        }
        $p = Child::whereIn('children.id', $id)->futureAttendance()->get(
            ['pa.date as date', 'children.name as name', 'pa.type as type']
        );
        return $p;
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function children($id)
    {
        $children = Parents::with('children')->where('id', $id)->first()->children()->get();
       
        return $children;
        
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function calendar($id)
    {
        $children = Parents::with('children')->where('id', $id)->first()->children;
        $id = [];
       
        foreach($children as $child){
            array_push($id, $child->id);
        }


        $p = Child::whereIn('children.id', $id)->futureAttendance()->get(
            ['pa.date as date', 'children.name as child', 'pa.type as type']
        );
        return $p;
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newAttendance($id, Request $request){
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
       
        return 'SUCCES';
    }

}
