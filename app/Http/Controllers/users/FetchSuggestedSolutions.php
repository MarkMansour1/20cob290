<?php

namespace App\Http\Controllers\users;

use DB;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FetchSuggestedSolutions extends Controller
{

  public function __construct() {
    $this->middleware('auth');
  }
  public function index(Request $request){
    
    $solutions = DB::select("SELECT `id`,`solution`,`solution_description`, `sub_problem_type_id`,`times_used` 
    FROM `solution` 
    WHERE `super_problem_type_id` = ? ORDER BY `times_used` DESC", [$request->get('superProblemTypeID')]);

    return response()->json(['solution'=>$solutions]);


  }

}