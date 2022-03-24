<?php

namespace App\Http\Controllers\users;

use DB;
use App\Http\Requests;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProvideSolution extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $problemId = $request->get('problemId');
        $solution = $request->get('solution');
        $solutionDescription  = $request->get('solutionDescription');

        $problemDetails = collect(\DB::select("SELECT problem.sub_problem_type_id, problem.super_problem_type_id FROM problem 
        WHERE problem.id = ?", [$problemId]))->first();

        $solutionId = DB::table('solution')->insertGetId([
            'solution' => $solution,
            'solution_description' => $solutionDescription,
            'times_used' => '0',
            'sub_problem_type_id' => $problemDetails->sub_problem_type_id,
            'super_problem_type_id' => $problemDetails->super_problem_type_id
        ]);

        DB::update("UPDATE problem SET status = 1,solution_id = ?, time_solved = ? WHERE problem.id = ?", [$solutionId, date('Y-m-d H:i:s'),$problemId]);
    }
}
