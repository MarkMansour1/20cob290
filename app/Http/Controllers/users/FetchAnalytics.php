<?php

namespace App\Http\Controllers\users;

use DB;
use App\Http\Requests;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FetchAnalytics extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        
    }

    public function index()
    {
        if (Auth::user()->job_title != 'analyst')  {
            return redirect()->guest('login');
        }
        $analyticsCardData = $this->fetchAnalyticsCardData();
        $topSpecialistDetails = $this->fetchTopSpecialistDetails();
        $topEquipmentsDetails = $this->fetchTopEquipments();
        $worstEquipmentsDetails = $this->fetchWorstEquipments();
        $mostReportedProblems = $this->fetchMostReportedProblems();
        $allSpecialistsID = $this->fetchAllSpecialistID();
        $allEquipmentSerialNumber = $this->fetchAllEquipmentSerialNumber();
        $fetchOtherProblems = $this->fetchOtherProblems();

        return view('user.analyst.analytics', ['analyticsCardData' => $analyticsCardData, 
        "topSpecialistData" => $topSpecialistDetails, 
        "topEquipmentsData"=> $topEquipmentsDetails,
        "worstEquipmentsData"=>$worstEquipmentsDetails,
        "mostReportedProblems"=>$mostReportedProblems,
        "allSpecialistID" => $allSpecialistsID,
        "allEquipmentSetialNumber" => $allEquipmentSerialNumber,
        "otherProblemDetails" => $fetchOtherProblems]);
    }


    function fetchAnalyticsCardData()
    {
        $data = array();

        $data["solvedBySpecialist"] = ($this->fetchProblemsSolvedBySpecialist())->problems_count;
        $data["problemsReported"] = ($this->fetchProblemsReported())->problems_count;
        $data["pendingSolution"] = ($this->fetchProblemsPendingSolution())->problems_count;
        $data["solvedBySystem"] = ($this->fetchProblemsSolvedBySystem())->problems_count;



        return $data;
    }

    function fetchProblemsSolvedBySpecialist() {
        $problemsCount = collect(\DB::select("SELECT COUNT(*) AS 'problems_count' FROM `problem` WHERE specialist_id IS NOT NULL AND solution_id IS NOT NULL"))->first();

        return $problemsCount;
    }

    function fetchProblemsReported() {
        $problemsCount = collect(\DB::select("SELECT COUNT(*) AS 'problems_count' FROM `problem`"))->first();

        return $problemsCount;
    }

    function fetchProblemsPendingSolution() {
        $problemsCount = collect(\DB::select("SELECT COUNT(*) AS 'problems_count' FROM `problem` WHERE solution_id IS NULL"))->first();

        return $problemsCount;
    }

    function fetchProblemsSolvedBySystem() {
        $problemsCount = collect(\DB::select("SELECT COUNT(*) AS 'problems_count' FROM `problem` WHERE specialist_id IS NULL"))->first();

        return $problemsCount;
    }

    function fetchTopSpecialistDetails() {
        $data = array();
        $stats = $this->fetchTopSpecialistStats();
        $specialities = $this->fetchTopSpecialistSpecialities($stats->specialist_id);
        $personalInfo = $this->fetchTopSpecialistPersonlInfo($stats->specialist_id);

        $data["stats"] = $stats;
        $data["specialities"] = $specialities;
        $data["personalInfo"] = $personalInfo;

        return $data;
    }

    function fetchTopSpecialistStats() {
        $stats = collect(\DB::select("SELECT problem.specialist_id, count(*) AS 'jobs', 
        specialist.no_of_jobs AS 'pendingProblems' , 
        AVG(TIME_TO_SEC(TIMEDIFF(problem.time_solved,problem.time_submitted))) AS 'avgResolveTime' 
        FROM problem, specialist 
        WHERE specialist.id = problem.specialist_id 
        AND problem.specialist_id IS NOT NULL 
        AND problem.solution_id IS NOT NULL 
        GROUP BY problem.specialist_id 
        ORDER BY ((count(*)*AVG(TIME_TO_SEC(TIMEDIFF(problem.time_solved,problem.time_submitted))))/pendingProblems)
        "))->first();
        
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

    function fetchTopEquipments() {
        $data = DB::select("SELECT equipment.serial_no, equipment.type, equipment.make, branch.city, branch.country, count(*) AS 'problemsReported' 
        FROM equipment, problem, branch 
        WHERE equipment.serial_no = problem.serial_no 
        AND equipment.branch_id = branch.id 
        GROUP BY problem.serial_no, branch.id 
        ORDER BY count(*) ASC LIMIT 3");

        return $data;
    }

    function fetchWorstEquipments() {
        $data = DB::select("SELECT equipment.serial_no, equipment.type, equipment.make, branch.city, branch.country, count(*) AS 'problemsReported' 
        FROM equipment, problem, branch 
        WHERE equipment.serial_no = problem.serial_no 
        AND equipment.branch_id = branch.id 
        GROUP BY problem.serial_no, branch.id 
        ORDER BY count(*) DESC LIMIT 3");

        return $data;
    }

    function fetchMostReportedProblems() {
        $data = DB::select("SELECT super_problem_type.name AS 'superType', sub_problem_type.name AS 'subType', count(*) 
        AS 'problemsReported' 
        FROM super_problem_type, sub_problem_type, problem 
        WHERE problem.sub_problem_type_id = sub_problem_type.id 
        AND sub_problem_type.super_type_id = super_problem_type.id 
        GROUP BY problem.sub_problem_type_id 
        ORDER BY count(*) DESC LIMIT 5");

        return $data;
    }

    function fetchAllSpecialistID() {
        $data = DB::select("SELECT id FROM specialist");

        return $data;
    }

    function fetchAllEquipmentSerialNumber() {
        $data = DB::select("SELECT serial_no FROM equipment");

        return $data;
    }

    function fetchOtherProblems() {
        $data = DB::select("SELECT problem.id, problem.problem_description, problem.time_submitted 
        FROM problem,sub_problem_type 
        WHERE problem.super_problem_type_id = 6 OR problem.sub_problem_type_id = sub_problem_type.id 
        AND sub_problem_type.name = 'Other' 
        AND problem.specialist_id IS NOT NULL GROUP BY problem.id ORDER BY problem.time_submitted ASC");

        return $data;
    }

   
}
