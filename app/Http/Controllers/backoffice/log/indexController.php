<?php

namespace App\Http\Controllers\Backoffice\Log;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Child;
use App\Models\PlannedAttendance;

class IndexController extends Controller
{
    public function index(){
        $date = \Carbon\Carbon::now();
        echo  \Carbon\Carbon::today()->toDateString();

        
        $log = DB::table('planned_attendances')
        ->whereDate('planned_attendances.updated_at', '=', date('Y-m-d'))
        ->join('children', 'children.id', '=', 'planned_attendances.child_id')
        ->select('children.name', 'planned_attendances.*')
        ->get();

        var_dump($log);

        return view('log.index', compact('log'));
    }    
}

