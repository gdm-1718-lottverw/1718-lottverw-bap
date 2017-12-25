<?php

namespace App\Http\Controllers\Backoffice\Filter;


use App\Models\Child;
use App\Models\Allergie;
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
        $conditions = [
            'organization_id' => 1, 
            'date' => Carbon::today()
        ];
        $planned = [];

        return view('filter.index', compact(['planned', 'or']));
    }
    
    public function create(request $request){       
        $data = $request->data;
        $date = $request->date;
        $general_conditions = [
            'organization_id' => 1, 
            'date' => $date
        ];
        
        $type_conditions = []; $child_conditions = []; $allergie_conditions = []; $present = '';
        foreach($data as $d){
            $key = array_keys($d)[0];
            $value = array_values($d)[0];
            switch($key){
                case 'present':
                    $present = $value[0];
                    break;
                case 'age':
                     $child_conditions[$key] = $value;
                     break; 
                case 'type':
                    $type_conditions[$key] = $value;
                    break; 
                case 'picture':
                    $picture = $value;
                    break; 
                case 'allergie':
                    $allergie_conditions[$key] = $value;
                    break; 
            }
        }

        $children = Child::general($general_conditions)
            ->type($type_conditions)
            ->present($present)
            ->allergies($allergie_conditions)
            ->age($child_conditions)
            ->get();

       // dump($children);
        return view('filter.children', compact('children'));
    }

}
