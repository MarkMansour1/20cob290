<?php

namespace App\Http\Controllers\users;

use DB;
use App\Http\Requests;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FetchLookupSpecialistDetails extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
      $specialistID = $request->get('specialistID');
      $data = array();
      $stats = $this->fetchTopSpecialistStats($specialistID);
      $specialities = $this->fetchTopSpecialistSpecialities($specialistID);
      $personalInfo = $this->fetchTopSpecialistPersonlInfo($specialistID);

      $data["stats"] = $stats;
      $data["specialities"] = $specialities;
      $data["personalInfo"] = $personalInfo;

      return $data;
      
    }

    function fetchTopSpecialistStats($specialistID) {
        $stats = collect(\DB::select("SELECT specialist.id, count(*) AS 'jobs', 
        specialist.no_of_jobs AS 'pendingProblems' , 
        AVG(TIME_TO_SEC(TIMEDIFF(problem.time_solved,problem.time_submitted))) AS 'avgResolveTime' 
        FROM problem, specialist 
        WHERE problem.specialist_id = ? 
        AND problem.specialist_id = specialist.id 
        AND problem.specialist_id IS NOT NULL AND problem.solution_id IS NOT NULL GROUP BY specialist.id",[$specialistID]))->first();
        
        if($stats === null) {
          $stats = collect(\DB::select("SELECT specialist.id, 0 AS 'jobs', 
          specialist.no_of_jobs AS 'pendingProblems' , 
          NULL AS 'avgResolveTime' 
          FROM specialist 
          WHERE specialist.id = ?",[$specialistID]))->first();
        }
        return $stats;
    }

    function fetchTopSpecialistSpecialities($specialistID) {
        $specialities = DB::select("SELECT super_problem_type.name 
        FROM super_problem_type, expertise 
        WHERE expertise.super_problem_type_id = super_problem_type.id 
        AND expertise.specialist_id = ?", [$specialistID]);

        return $specialities;
    }

    function fetchTopSpecialistPersonlInfo($specialistID) {
        $personalInfo = collect(\DB::select("SELECT users.name, branch.city, branch.country 
        FROM specialist, users, branch 
        WHERE specialist.personnel_id = users.id 
        AND users.branch_id = branch.id AND specialist.id = ?", [$specialistID]))->first();

        return $personalInfo;
    }

   
}
