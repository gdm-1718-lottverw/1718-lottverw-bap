<?php

namespace App\Http\Controllers\Backoffice\Child;


use App\Models\Child;
use App\Models\Parents as Parents;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    private $child_id;
    public function index(int $child_id){
        $this->child_id = $child_id;
        /**
         * Select all child data from the database.
         */
        $child = DB::table('children')
            ->join('doctors', 'children.id', '=', 'doctors.children_id')
                    ->where([
                        ['doctors.children_id', '=', $this->child_id],
                        ['children.id', '=', $this->child_id]
                        ])
            ->join('addresses', 'children.id', '=', 'addresses.children_id')
            ->first(
                [ 'doctors.name as doctor', 
                  'doctors.phone_number as doctor_phone',
                  'children.name as name', 
                  'children.date_of_birth as birthday',
                  'children.gender',
                  'children.potty_trained',
                ]);
            
        $addresses = DB::table('addresses')->where('addresses.children_id', '=', $this->child_id)->get();
        $allergies = DB::table('allergies')->where('allergies.children_id', '=', $this->child_id)->get();
        $pedagogic = DB::table('pedagogic_reports')->where('pedagogic_reports.children_id', '=', $this->child_id)->get();
        $medical = DB::table('medical_attention')->where('medical_attention.children_id', '=', $this->child_id)->get();
        $other_information = DB::table('other_information')->where('other_information.children_id', '=', $this->child_id)->get(['description as message']);
        
        $parents = DB::table('parents')
        ->join('child_parents', function($join){
            $join->on('child_parents.parent_id', '=', 'parents.id')
                ->where([
                    ['child_parents.child_id', '=', $this->child_id],
                ]);
            })
            ->get(['parents.name as name', 'parents.relation as relation', 'parents.phone_number as phone']);
        
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
    
}