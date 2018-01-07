<?php

namespace App\Http\Controllers\API\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use JWTAuth;

use App\Models\Parents;
use App\Models\Address;
use App\Models\Child;
use App\Models\Allergie;
use App\Models\MedicalReport;
use App\Models\Doctor;
use App\Models\PedagogicReport;
use App\Models\OtherInformation;
use App\Models\Guardian;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        /**
         * DATA STRUCTURE
         *   { 
         *      "address": {  
         *          "street": "street", 
         *          "number":"number", 
         *          "city": "city", 
         *          "postal_code": "postal_code", 
         *          "country": "country" 
         *      },
         *      "guardians": [{
         *          "name": "name",
         *          "tel": "tel"
         *      }],
         *      "parents": [
         *          {
         *               "name": "name",
         *               "relation": "relation",
         *               "tel": "tel",
         *               "email": "email"
         *           },
         *           {
         *               "name": "name",
         *               "relation": "relation",
         *               "tel": "tel",
         *               "email": "email"
         *           }
         *       ],
         *       "children": [
         *           {
         *               "name": "name",
         *               "date_of_birth": "date_of_birth", 
         *               "gender": "gender",
         *               "pictures": true, 
         *               "potty_trained": false, // if false add
         *               "doctor": {
         *                   "name": "name", 
         *                   "tel": "tel"
         *               }, 
         *               "medical": [ // if present
         *                   {
         *                       "description": "description", 
         *                       "prescription": "prescription", 
         *                       "medication": "medication"
         *                   }
         *               ],
         *               "pedagogic": [ // if present
         *                   {
         *                       "description": "description", 
         *                       "prescription": "prescription", 
         *                       "medication": "medication"
         *                   }
         *               ],
         *               "allergies": // if present
         *                   {
         *                       "description": "description", 
         *                       "type": "type", 
         *                       "gravity": "gravity", 
         *                       "prescription": "prescription", 
         *                       "medication": "medication"
         *                   }
         *               ],
         *               "other_info": "other_info"
         *           }
         *       ]
         *       
         *   }
        */
        $data ;
        // 1. Get the auth key from the token.
        $id;
        // Get the authorization header.
        $string = $request->header('Authorization');
        // Shorten it.
        $token = substr($string, 7);
        // set the token so we can decode it later.
        JWTAuth::setToken($token);
        // Get the token again. 
        $token = JWTAuth::getToken();
        // Decode the token
        $decode = JWTAuth::decode($token)->toArray();
        // Get the auth key id from the token. aka. user identification. 
        $count = 0;
        foreach($decode as $d){
            if($count == 0){
                $id = $d;   
            }
            $count++;
        }
        // 2. Retreive all info
        $parent = Parents::where('auth_key_id', $id)->get(['address_id as address', 'id','name', 'phone_number as tel', 'relation', 'email']);
        $family_type = Parents::where('auth_key_id', $id)->first(['family_type']);
        // We can use $parent[0] because when parents are added to the database they are assigned the same address.
        $address = Address::where('id', $parent[0]->address)->first(); 
        $children = []; $ids = [];
        // Get all children
        foreach ($parent as $p) {
            $child = $p->children()->get(['id', 'name', 'date_of_birth', 'gender', 'potty_trained', 'pictures']);
            
            if(Count($child) > 0){
                $children = $child;
                
                for($i = 0; Count($child) > $i; $i++) {
                    $ids[$i] = $child[$i]['id'];
                    $a = Allergie::where('children_id', $child[$i]->id)->get(['id', 'type', 'gravity', 'description', 'medication', 'prescription']);
                    if(Count($a) > 0){
                        Count($children[$i]['allergie']) == 0? $children[$i]['allergies'] = $a: null;
                    }

                    $d = Doctor::where('children_id','=', $child[$i]->id)->first(['id', 'name', 'phone_number as tel']);
                    if(Count($d) > 0){
                        Count($children[$i]['doctors']) == 0? $children[$i]['doctor'] = $d: null;
                    }

                    $o = OtherInformation::where('children_id', $child[$i]->id)->get(['id', 'description']);
                    if(Count($o) > 0){
                        Count($children[$i]['comment']) == 0? $children[$i]['comments'] = $o: null;
                    }

                    $m = MedicalReport::where('children_id', $child[$i]->id)->get(['id', 'description', 'medication', 'prescription']);

                    if(Count($m) > 0){
                        Count($children[$i]['medial']) == 0? $children[$i]['medical'] =  $m: null;
                    }

                    $p = PedagogicReport::where('children_id', $child[$i]->id)->get(['id', 'description', 'medication', 'prescription']);
                    if(Count($p) > 0){
                        Count($children[$i]['pedagogic']) == 0? $children[$i]['pedagogic'] = $p : null;
                    }
                }
            }
        }

        $guardians = Guardian::whereHas('children', function($q) use($ids) {
            $q->whereIn('child_id', $ids);
        })->get();

        // Merge all info into one pretty object.
        $data['parents'] =  $parent;
        $data['guardians'] =  $guardians;
        $data['address'] =  $address;
        $data['children'] =  $children;
        $data['family_type'] = $family_type->family_type;

        return $data;
    }
}
