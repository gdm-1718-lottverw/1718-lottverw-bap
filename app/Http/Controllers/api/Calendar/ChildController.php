<?php

namespace App\Http\Controllers\API\Calendar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Guardian;
use App\Models\Parents;


class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $children = Parents::with('children')->where('id', $id)->first()->children()->get(['id', 'name']);  
        $ids = [];
        foreach ($children as $child) {
            $id =  $child->guardians()->get(['guardian_id']);
            foreach($id as $i){
                array_push($ids, $i['guardian_id']);
            }
        }

        $guardians = Guardian::whereIn('id', $ids)->get(['id', 'name']);
        $default = array("id" => null, "name" => "Ouders", "selected" => true);
        $guardians[Count($guardians)] = $default;

        $result = [
            'children' => $children,
            'guardians' => $guardians,
        ];
        
        return $result; 
    }

}
