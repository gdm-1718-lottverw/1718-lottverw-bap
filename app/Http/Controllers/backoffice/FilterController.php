<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Child;
use App\Models\Organization;

class FilterController extends Controller
{

    public function index(request $request){
        
        $test = Child::where('organization_id', 4)->get();
        //return $request;
        return view('filter.test', compact('test'));
    }
    
    public function create(request $request){
        
        $test = Child::where('organization_id', 4)->where('potty_trained', false)->get();
        
        return view('filter.children', compact('test'));
    
    }
}
