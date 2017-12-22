<?php

namespace App\Http\Controllers\Backoffice\Filter;


use App\Models\Child;
use App\Models\Organization;
use App\Models\PlannedAttendance;
use App\Http\Controllers\Controller; 
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    /**
     * 
     * @TODO Maak alle functies aan om waarden te controlleren in de modellen. 
     * Vervolgens kijk je naar het post object of een waarde geselecteerd is met isset(). 
     * 
     */
    private $date = "";

    public function index(){
        $or = Organization::where('id', 1);
        $planned = 
            PlannedAttendance::with('child')
                ->present(Carbon::today(), 1, 'in')
                ->get();

        return view('filter.index', compact(['planned', 'or']));
    }
    
    public function create(request $request){       
        dump($request);
        return ;
    }

    
}
