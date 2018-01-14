<?php

namespace App\Http\Controllers\Backoffice\Parents;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\AuthKey;
use App\Models\Organization;
use App\Models\Parents;
use App\Models\Guardian;
use App\Models\Address;
use App\Models\Role;

use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
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
