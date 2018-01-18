<?php

namespace App\Http\Controllers\Backoffice\Filter;


use App\Models\Child;
use App\Models\Allergie;
use App\Models\Organization;
use App\Models\PlannedAttendance;
use App\Http\Controllers\Controller; 
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{

    private $date = "";  private $organization_id;

    public function index(){
        $this->organization_id = helper_loggedInOrganization();
        $or = Organization::where('id', $this->organization_id)->orWhere('main_organization');
        $conditions = [
            'organization_id' =>  $this->organization_id, 
            'date' => Carbon::today()
        ];

        $planned = Child::general($conditions)->presence('present_present')->get();

        return view('filter.index', compact(['planned', 'or']));
    }
    
    public function create(request $request){    
        $this->organization_id = helper_loggedInOrganization();  
        $data = $request->data; $date = $request->date; $age = $request->age[0]['age'];
        $general_conditions = [
            'organization_id' => $this->organization_id,  
            'date' => $date
        ];
        $type_conditions = []; $allergie_conditions = [];
        $present = ''; $birthday = false; $picture = ''; $potty_trained = '';

        foreach($data as $d){
            $key = array_keys($d)[0];
            $value = array_values($d)[0];
            switch($key){
                case 'present':
                    $present = $value[0];
                    break;
                case 'birthday':
                    $birthday = $value[0];
                    break;
                case 'type':
                    $type_conditions[$key] = $value;
                    break; 
                case 'picture':
                    $picture = $value;
                    break; 
                case 'potty_trained':
                    $potty_trained = $value;
                    break; 
                case 'allergie':
                    $allergie_conditions[$key] = $value;
                    break; 
            }
        }

        $children = Child::general($general_conditions)
            ->presence($present)
            ->type($type_conditions)
            ->age($age)
            ->pictures($picture)
            ->pottyTrained($potty_trained)
            ->birthday($birthday) 
            ->allergies($allergie_conditions)
            ->groupBy('children.id')
            ->get(['children.name as name', 'children.date_of_birth', 'children.id', 'children.pictures', 'children.potty_trained', 'pa.type as day_type', 'al.gravity', 'al.description', 'al.type as allergie', 'pa.parent_notes']);
        
      
        return view('filter.children', compact('children'));
    }

}
