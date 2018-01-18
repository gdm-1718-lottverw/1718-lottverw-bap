<?php

namespace App\Http\Controllers\Backoffice\Lists;

use App\Models\Child;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Organization;

class IndexController extends Controller
{

	private $organization_id;

  public function index(){
    $this->organization_id = helper_loggedInOrganization();

    $children = Child::where('organization_id', $this->organization_id)->get(['children.id', 'children.name']);
    return view('list.index', compact('children'));
  }    
}