<?php

namespace App\Http\Controllers\Backoffice\Lists;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(){

        $children = DB::table('children')
                ->where([
                    ['children.organization_id', '=', 1],
                ])->get(['children.id', 'children.name']);
        
        return view('list.index', compact('children'));
    }
    
}