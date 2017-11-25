<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Child;
use App\Models\Organization;

class FilterController extends Controller
{
    public function index(){
    
        $children = Child::where('organization_id', 4)->get();

        return view('filter/test', compact('children'));
    }
    
    public function create(request $request){

        $result = DB::table('children')->where('potty_trained', false)->get(['id', 'name']);
        
        return $result;

    }
}
