<?php

namespace App\Http\Controllers\users;

use DB;
use App\Http\Requests;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CloseProblem extends Controller
{

  public function __construct() {
    $this->middleware('auth');
  }

  public function index(Request $request) {
    $problemId = $request->get('problemId');

    DB::update("UPDATE problem SET status = 2 WHERE problem.id = ?",[$problemId]);

    $problemDetails = collect(\DB::select("SELECT problem.solution_id, solution.times_used FROM problem,solution 
    WHERE problem.id = ? AND problem.solution_id = solution.id", [$problemId]))->first();
    
    $times_used = $problemDetails->times_used + 1;
    DB::update("UPDATE `solution` SET `times_used` = ? WHERE `solution`.`id` = ?", [$times_used, $problemDetails->solution_id]);


  }

}