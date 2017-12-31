<?php

namespace App\Http\Controllers\API\History;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Parents;
use App\Models\Child;


class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $children = Parents::with('children')->where('id', $id)->first()->children()->get();
                $id = [];
       
        foreach($children as $child){
            array_push($id, $child->id);
        }

        $history = Child::whereIn('children.id', $id)
            ->historyAttendance()
            ->get(
            ['pa.date as date', 'children.name']
        );
        return $history;
        
    }
}
