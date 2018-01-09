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

class ProfileController extends Controller
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
                    Count($children[$i]['allergie']) == 0? $children[$i]['allergies'] = $a: $children[$i]['allergies'] = [];

                    $d = Doctor::where('children_id','=', $child[$i]->id)->first(['id', 'name', 'phone_number as tel']);
                    Count($children[$i]['doctors']) == 0? $children[$i]['doctor'] = $d: $children[$i]['doctor'] = [];
                  
                    $o = OtherInformation::where('children_id', $child[$i]->id)->get(['id', 'description']);
                    Count($children[$i]['comment']) == 0? $children[$i]['comments'] = $o: $children[$i]['comments'] = [];

                    $m = MedicalReport::where('children_id', $child[$i]->id)->get(['id', 'description', 'medication', 'prescription']);
                    Count($children[$i]['medial']) == 0? $children[$i]['medical'] =  $m: $children[$i]['medical'] = [];
                    

                    $p = PedagogicReport::where('children_id', $child[$i]->id)->get(['id', 'description', 'medication', 'prescription']);
                    Count($children[$i]['pedagogic']) == 0? $children[$i]['pedagogic'] = $p : $children[$i]['pedagogic'] = [];
                    
                }
            }
        }

        $guardians = Guardian::whereHas('children', function($q) use($ids) {
            $q->whereIn('child_id', $ids);
        })->get(['guardians.id', 'guardians.name', 'guardians.phonenumber as tel']);

        // Merge all info into one pretty object.
        $data['parents'] =  $parent;
        $data['guardians'] =  $guardians;
        $data['address'] =  $address;
        $data['children'] =  $children;
        $data['family_type'] = $family_type->family_type;

        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request->parent == true){
            foreach ($request->parents as $parent) {
                $p = Parents::find($parent['id']);
                $p->fill(['email' => $parent['email'], 'phone_number' => $parent['tel']]);
                $p->save();
            }
        }

        if($request->child == true){

            foreach ($request->children as $child) {
                $update = Child::find($child['id']);
                $update->fill(['potty_trained' => $child['potty_trained'], 'pictures' => $child['pictures']]);
                $update->save();
                //IF NOT DELETE TE CONDITION
                foreach ($child['medical'] as $care) {
                    // IF THERE IS NO ID CREATE NEW
                    if(!isset($care['id'])){
                        $m = new MedicalReport;
                        $m->description = $care['description'];
                        $m->children_id = $child['id'];
                        $m->save();
                    } else if(isset($care['delete'])){
                        $m = MedicalReport::find($care['id']);
                        $m->delete();
                    } else if (!isset($care['delete'])) { 
                        $m = MedicalReport::find($care['id']);
                        $m->fill(['description' => $care['description']]);
                        $m->save();
                    }
                };

                 
                        $doctor = $child['doctor'] ;
                        $m = Doctor::find($doctor['id']);
                        $m->fill(['name' => $doctor['name'], 'phone_number' => $doctor['tel']]);
                        $m->save();

                foreach ($child['comments'] as $comment) {
                    // IF THERE IS NO ID CREATE NEW
                    if(!isset($comment['id'])){
                        $m = new OtherInformation;
                        $m->description = $comment['description'];
                        $m->children_id = $child['id'];
                        $m->save();
                    } else if(isset($comment['delete'])){
                        $m = OtherInformation::find($comment['id']);
                        $m->delete();
                    } else if (!isset($comment['delete'])) { 
                        $m = OtherInformation::find($comment['id']);
                        $m->fill(['description' => $comment['description']]);
                        $m->save();
                    }
                };

                foreach ($child['pedagogic'] as $care) {
                    // IF THERE IS NO ID CREATE NEW
                    if(!isset($care['id'])){
                        $m = new PedagogicReport;
                        $m->description = $care['description'];
                        $m->children_id = $child['id'];
                        $m->save();
                    } else if(isset($care['delete'])){
                        $m = PedagogicReport::find($care['id']);
                        $m->delete();
                    } else if (!isset($care['delete'])) { 
                        $m = PedagogicReport::find($care['id']);
                        $m->fill(['description' => $care['description']]);
                        $m->save();
                    }

                };
                foreach ($child['allergies'] as $care) {
                    // IF THERE IS NO ID CREATE NEW
                    if(!isset($care['id'])){
                        $m = new Allergie;
                        $m->description = $care['description'];
                        $m->type = $care['type'];
                        $m->gravity = $care['gravity'];
                        $m->children_id = $child['id'];
                        $m->save();
                    } else if(isset($care['delete'])){
                        $m = Allergie::find($care['id']);
                        $m->delete();
                    } else if (!isset($care['delete'])) { 
                        $m = Allergie::find($care['id']);
                        $m->fill(['description' => $care['description'], 'type' => $care['type'], 'gravity' => $care['gravity']]);
                        $m->save();
                    }

                };
            }
        }
 
        if($request['guardian'] == true){
            foreach ($request->guardians as $guardian ) {
                if(!isset($guardian['id'])){
                    $g = new Guardian;
                    $g->phonenumber = $guardian['tel'];
                    $g->name = $guardian['name'];
                    $g->save();
                    foreach ($request['children'] as $child) {
                        $c = Child::find($child['id']);
                        $c->guardians()->attach($g->id);
                    }
                } 
                else if(isset($guardian['delete'])){
                    $g = Guardian::find($guardian['id']);
                    $g->delete();
                } 
                else if (!isset($guardian['delete'])){
                    $g = Guardian::find($guardian['id']);
                    $g->fill(['name' => $guardian['name'], 'phonenumber' => $guardian['tel']]);
                    $g->save();
                }
            }
        }
        if($request->address == true){
            $address = Address::find($request->address_id);
            $address->fill(['street' => $request->street, 'number' => $request->number, 'city' => $request->city, 'postal_code' => $request->postal_code, 'country' => $request->country]);
            $address->save();  
        }
        return 'success';
    }
}
