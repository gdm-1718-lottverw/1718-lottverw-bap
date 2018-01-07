<?php

namespace App\Http\Controllers\API\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use JWTAuth;

use App\Models\Parents;
use App\Models\Child;


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
        // 2. Retreive all parents from the auth_key_id
        $parent_info = Parents::where('auth_key_id', $id)->get(['id','name', 'phone_number as tel', 'relation', 'email']);
        $family_type = Parents::where('auth_key_id', $id)->first(['family_type']);
        $address = Address::where('parent_id', $parent_info->id)->first();
        $data['parents'] =  $parent_info;
        $data['family_type'] = $family_type->family_type;
        return $data;
        // 3. Retreive the address
        // 4. Retreive all children for the parents.
        // 5. retreive the guardians
        // §. Retreive all doctors, other info, allergies, medical en pedagogic care for each child.
    }
}
