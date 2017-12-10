<?php

namespace App\Http\Controllers\Backoffice\Log;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Child;
use App\Models\PlannedAttendance;
use App\Models\Log;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $log = 
        DB::table('logs')
        ->where([
            [DB::raw('date(logs.created_at)'), '=',\Carbon\Carbon::today()],
            ['logs.organization_id', '=', 1],
            ['logs.deleted_at', '=', null]
        ])
        ->join('children', 'children.id', '=', 'logs.child_id')
        ->join('actions', 'actions.id', '=', 'logs.action_id')
        ->orderBy('logs.action_time', 'desc')
        ->get(['logs.updated_at', 'logs.id as id', 'actions.name as action', 'logs.action_time as time', 'children.name']);
        
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
        $child = $log->child_id;

        $pa = PlannedAttendance::where([
            ['child_id', '=', $child],
            ['date', '=', date('Y-m-d')]
        ])->first();

        if($action == 1){
            $pa->in = 0;
            $pa->save();
        } elseif($action == 2) {
            $pa->out = 0;
            $pa->save();
        }

        return redirect()->action('Backoffice\Log\IndexController@index');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
