<?php

namespace App\Http\Controllers\API\Calendar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $children = Parents::with('children')->where('id', $id)->first()->children()->get();  
        return $children;
        
    }
}
