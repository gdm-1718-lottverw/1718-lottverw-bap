<?php

namespace App\Http\Controllers\Backoffice\Privacy;

use App\Http\Controllers\Controller; 

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('privacy.index');
    }
}
