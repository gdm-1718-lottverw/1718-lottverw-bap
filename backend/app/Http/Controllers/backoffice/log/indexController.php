<?php

namespace App\Http\Controllers\Backoffice\Log;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Child;

use App\Models\Organization;
use App\Models\PlannedAttendance;
use App\Models\Log;


use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller; 

class IndexController extends Controller
{
    private $organization_id;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->organization_id = helper_loggedInOrganization();
        $general_conditions = [
            'organization_id' => $this->organization_id,
            'deleted_at' => null,
        ];
        $log = Log::general($general_conditions)
            ->actionName()->where('logs.created_at', '>=', Carbon::today())
            ->orderBy('logs.action_time', 'desc')
            ->get(['logs.updated_at', 'logs.id as id', 'actions.name as action', 'logs.action_time as time', 'pa.type', 'child.name']);

        return view('log.index', compact('log'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {       
        $log = Log::find($id);
        $log->action_time = $request->time;
        $log->save();
        return redirect()->action('Backoffice\Log\IndexController@index');
    }
    
    /**
     * Soft delete a record
     *
     * @param  int  $id
     */
    public function delete($id)
    {
        $log = Log::find($id);
        $log->deleted_at = date('Y-m-d H:i:s');
        $log->save();

        $action = $log->action_id;

        $pa = PlannedAttendance::find($log->planned_attendance_id);
        if($action == 1){
            $pa->in = 0;
            $pa->save();
        } elseif($action == 2) {
            $pa->out = 0;
            $pa->save();
        }

        return redirect()->action('Backoffice\Log\IndexController@index');
    }
}
