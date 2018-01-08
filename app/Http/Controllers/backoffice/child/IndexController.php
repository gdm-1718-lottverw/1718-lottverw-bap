<?php

namespace App\Http\Controllers\Backoffice\Child;


use App\Models\Child;
use App\Models\Allegie;
use App\Models\AuthKey;
use App\Models\Guardian;
use App\Models\Organization;
use App\Models\PedagogicReport;
use App\Models\MedicalReport;
use App\Models\Allergie;
use App\Models\Address;
use App\Models\Doctor;
use App\Models\OtherInformation;
use App\Models\Parents as Parents;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    private $organization_id;
    function helper_loggedInOrganization(){
        $key = Auth::id();
        $o= Organization::where('auth_key_id', $key)->first();
        $this->organization_id = $o->id;  
    }

    public function index(int $child_id){
        $this->child_id = $child_id;
        /**
         * Select all child data from the database.
         */
        $child = DB::table('children')
            ->join('doctors', 'children.id', '=', 'doctors.children_id')
            ->first(
                [ 'doctors.name as doctor', 
                  'doctors.phone_number as doctor_phone',
                  'children.name as name', 
                  'children.date_of_birth as birthday',
                  'children.gender',
                  'children.potty_trained',
                ]);

        $allergies = DB::table('allergies')->where('allergies.children_id', '=', $this->child_id)->get();
        $pedagogic = DB::table('pedagogic_reports')->where('pedagogic_reports.children_id', '=', $this->child_id)->get();
        $medical = DB::table('medical_attention')->where('medical_attention.children_id', '=', $this->child_id)->get();
        $other_information = DB::table('other_information')->where('other_information.children_id', '=', $this->child_id)->get(['description as message']);
        
        $parents = DB::table('parents')
        ->join('addresses', function($join){
            $join->on('parents.address_id', '=', 'addresses.id');
        })
        ->join('child_parents', function($join){
            $join->on('child_parents.parent_id', '=', 'parents.id')
                ->where([
                    ['child_parents.child_id', '=', $this->child_id],
                ]);
            })
            ->get(['parents.name as name', 'parents.relation as relation', 'parents.phone_number as phone', 'parents.id as id', 'addresses.street', 'addresses.number', 'addresses.city', 'addresses.postal_code', 'addresses.country']);
        
        $guardians = DB::table('guardians')
            ->join('child_guardian', function($join){
                $join->on('child_guardian.guardian_id', '=', 'guardians.id')
                    ->where([
                        ['child_guardian.child_id', '=', $this->child_id],
                    ]);
                })
                ->get(['guardians.name as name', 'guardians.phonenumber as phone']);
    
        return view('child.index', compact(['child', 'addresses', 'allergies', 'pedagogic', 'medical', 'other_information', 'parents', 'guardians']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $data = session('data');
        $parents = $data['parents'];
        $guards = $data['guard'];

        return view('child.new', compact('parents', 'guards'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $this->helper_loggedInOrganization();
        
        $validatedData = $request->validate([
            'doctor' => 'required|string',
            'doctor_phone' => 'required|string',
            'child_name' => 'required|string',
            'national_regestry_number' => 'required|string|min:11',
            'gender' => 'required|string',
            'date_of_birth' => 'required|date',
            'potty_trained' => 'required|bool',
            'picture' => 'required|bool',
        ]);


        $child = new Child;
        $child->name = $request['child_name'];
        $child->potty_trained = $request['potty_trained'];
        $child->pictures = $request['picture'];
        $child->national_regestry_number = $request['national_regestry_number'];
        $child->gender = $request['gender'];
        $child->date_of_birth = $request['date_of_birth'];
        $child->organization_id = $this->organization_id;
        $child->save();
        
        //add parents and guards.
        for($i = 0; $i < 3; $i++){
            $id = $request['parent_'.$i];
            $child->parents()->attach($id);
        }
        for($i = 0; $i < 4; $i++){
            $id = $request['guard_'.$i];
            $child->guardians()->attach($id);
        }
            
        if($request['pedagogic_care_0'] != null && $request['pedagogic_care_0'] != 'undefined'){
            for($i = 0; $i < 5; $i++){
                $description = $request['pedagogic_care_'.$i];
                if($description != null){
                    $care = new PedagogicReport;
                    $care->description = $description;
                    $care->children_id = $child->id;
                    $care->save();
                } else { $i = 6;}
            }
            
        }

        if($request['medical_care_0'] != null && $request['medical_care_0'] != 'undefined'){
            for($i = 0; $i < 4; $i++){
                $description = $request['medical_care_'.$i];
                if($description != null){
                    $care = new MedicalReport;
                    $care->description = $description;
                    $care->children_id = $child->id;
                    $care->save();
                } else { $i = 5;}
            }
        }

        if($request['allergie_0'] != null && $request['allergie_0'] != 'undefined'){
            for($i = 0; $i < 4; $i++){
                $description = $request['allergie_'.$i];
                if($description != null){
                    $gravity = $request['allergie_gravity_'.$i];
                    $type = $request['allergie_type_'.$i];
                    
                    $care = new Allergie;
                    $care->description = $description;
                    $care->gravity = $gravity;
                    $care->type = $type;
                    $care->children_id = $child->id;
                    $care->save();

                } else { $i = 5;}
            }
        }

        if($request['doctor'] != null){
            $doctor = new Doctor; 
            $doctor->name = $request['doctor'];
            $doctor->phone_number = $request['doctor_phone'];
            $doctor->children_id = $child->id;
            $doctor->save();
        }
       
       if($request['other_info'] != null){
            $oi = new OtherInformation; 
            $oi->description = $request['other_info'];
            $oi->children_id = $child->id;
            $oi->save();
        }
        if($request['another_child'] == false){
            return redirect()->route('home');
        } else {
             return redirect()->route('createChild', ['auth_key_id' => $request->_id]);
        }
        
    }

}