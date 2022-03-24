<?php

namespace App\Http\Controllers\users;

use DB;
use Auth;
use App\Http\Requests;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostReportProblem extends Controller
{

  public function __construct() {
    $this->middleware('auth');
  }

  public function index(Request $request) {
    $needToAssignSpecialist = $request->get('needToAssignSpecialist');
    $superProblemType = $request->get('superProblemType');
    $problemSubtype = $request->get('problemSubtype');
    $description = $request->get('description');
    $software = $request->get('software');
    $equipment = $request->get('equipment');
    $solutionID = $request->get('solutionID');
    if($software == null) $software = "N\A";

    if($needToAssignSpecialist == true) {
      $specialist = $this->findSpecialist($superProblemType);
      $this->inserNewProblem($superProblemType, $problemSubtype, $description, $equipment, $software, NULL, $specialist->id);
      $this->updateSpecialistData($specialist);

      return response()->json(['specialst'=>$specialist]);
    }else {
      $this->inserNewProblem($superProblemType, $problemSubtype, $description, $equipment, $software, $solutionID, NULL);
      $this->updateSolutionTimesUsed($solutionID);
      return response()->json(['success'=>true]);
    }


  }

  function updateSolutionTimesUsed($solutionID) {
    $solutionTimesUsed = collect(\DB::select("SELECT times_used FROM solution WHERE solution.id = ?",[$solutionID]))->first();
    $times_used = $solutionTimesUsed->times_used + 1;
    DB::update("UPDATE `solution` SET `times_used` = ? WHERE `solution`.`id` = ?", [$times_used, $solutionID]);
  }

  function findSpecialist($superProblemType) {
    
    $specialist = collect(\DB::select("SELECT specialist.id,no_of_jobs, users.name FROM specialist, expertise,users 
    WHERE expertise.specialist_id = specialist.id AND users.id = specialist.personnel_id 
    AND expertise.super_problem_type_id = ? 
    AND specialist.status = 1 
    ORDER BY specialist.no_of_jobs ASC",[$superProblemType]))->first();

    if($specialist == NULL) {
      $specialist = collect(\DB::select("SELECT specialist.id,no_of_jobs, users.name FROM specialist,users WHERE specialist.status = 1 AND users.id = specialist.personnel_id ORDER BY specialist.no_of_jobs ASC"))->first();
    }

    return $specialist;
  }

  function updateSpecialistData($specialist) {
    $no_of_jobs = $specialist->no_of_jobs +1;
    DB::update("UPDATE specialist SET no_of_jobs = ? WHERE specialist.id = ?",[$no_of_jobs, $specialist->id]);
  }

  function inserNewProblem($superProblemType, $problemSubtype, $description, $equipment, $software, $solutionID ,$specialistID) {
    if($solutionID != null && $specialistID == null) {
      DB::insert("INSERT INTO problem
      (personnel_id, specialist_id, branch,time_submitted, 
      status, in_person ,super_problem_type_id, sub_problem_type_id, problem_description, 
      time_solved, solution_id, software, serial_no) 
      VALUES (:userID, NULL, :branch, :time_submitted, 2, 0,:super_problem_type,:sub_problem_type, :description, :time_solved, :solution_id, :software,:serial_no )",
      ["userID" => Auth::user()->id,
      "branch" => Auth::user()->branch_id,
      "time_submitted" => date('Y-m-d H:i:s'),
      "super_problem_type" => $superProblemType,
      "sub_problem_type" => $problemSubtype,
      "description" => $description,
      "time_solved" => date('Y-m-d H:i:s'),
      "solution_id" => $solutionID,
      "software"=>$software,
      "serial_no" => $equipment]);
    }elseif ($solutionID == null && $specialistID != null){
      DB::insert("INSERT INTO problem 
      (personnel_id, specialist_id, branch,time_submitted, status, in_person,
      super_problem_type_id, sub_problem_type_id, problem_description, time_solved, solution_id, software, serial_no) 
      VALUES (:userID, :specialist_id, :branch, :time_submitted, 0,0, :super_problem_type,:sub_problem_type, :description, NULL, NULL, :software,:serial_no )",
      ["userID" => Auth::user()->id,
      "specialist_id" => $specialistID,
      "branch" => Auth::user()->branch_id,
      "time_submitted" => date('Y-m-d H:i:s'),
      "super_problem_type" => $superProblemType,
      "sub_problem_type" => $problemSubtype,
      "description" => $description,
      "software"=>$software,
      "serial_no" => $equipment]);
    }
  }

}
