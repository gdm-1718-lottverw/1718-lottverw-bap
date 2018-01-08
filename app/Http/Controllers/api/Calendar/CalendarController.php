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
            foreach ($request->types as $type) {
                $calendar_item = new PlannedAttendance;
                $calendar_item->date = $request->date;
                $calendar_item->type = $type;
                $calendar_item->parent_notes = $request->parent_notes;
                $calendar_item->go_home_alone = $request->go_home_alone;
                $calendar_item->child_id = $id;
                $calendar_item->organization_id = $organization->id;
                $calendar_item->save();

            }
        }
       
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($parent_id, $item_id){
        $calendar_item = PlannedAttendance::where('id', $item_id)->first(['date', 'id', 'type', 'parent_notes', 'go_home_alone', 'child_id']);
        $children = Parents::with('children')->where('id', $parent_id)->first()->children()->get(['children.name as name', 'children.id as id']);
        $response = [
            'item' => $calendar_item,
            'children' => $children
        ];
        return $response;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update($parent_id, $item_id, Request $request){
        $calendar_item = PlannedAttendance::find($item_id);
        $calendar_item->fill($request->only(['type', 'child_id', 'parent_notes', 'date', 'go_home_alone']));
        $calendar_item->save();  

        return $calendar_item;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($parent_id, $pa_id){
            
        $calendar_item = PlannedAttendance::where('id', $pa_id)->first();
        $calendar_item->deleted_at = Carbon::now();
        $calendar_item->save();
        
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
