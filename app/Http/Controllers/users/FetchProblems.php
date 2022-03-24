<?php

namespace App\Http\Controllers\users;

use DB;
use App\Http\Requests;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FetchProblems extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    if (Auth::user()->job_title == 'specialist') {
      $specialistProblems = $this->fetchSpecialistProblems();
      $specialistPendingProblems = $this->fetchSpecialistPendingProblems();
      $specialistSolvedProblems = $this->fetchSpecialistSolvedProblems();

      return
        view('user.specialist.problems', ['specialistProblems' => $specialistProblems, 'specialistPendingProblems' => $specialistPendingProblems, 'specialistSolvedProblems' => $specialistSolvedProblems]);
    } else {
      $pendingSolution = $this->fetchPendingSolutionProblems();
      $solutionSuggested = $this->fetchSolutionSuggestedProblems();
      $solvedProblems = $this->fetchSolvedProblems();
      $autoSolvedProblems = $this->fetchAutoSolvedProblems();

      return view('user.problems', ['pendingSolution' => $pendingSolution, 'solutionSuggested' => $solutionSuggested, 'solvedProblems' => $solvedProblems, 'autoSolvedProblems' => $autoSolvedProblems]);
    }
  }


  function fetchPendingSolutionProblems()
  {
    $pendingSolution = DB::select("SELECT problem.id AS 'problem_id', 
    users.name AS 'specialist_name', 
    super_problem_type.name AS 'problem_type', 
    sub_problem_type.name AS 'title', 
    problem.status FROM problem, specialist, users,sub_problem_type, super_problem_type 
    WHERE specialist.id = problem.specialist_id AND problem.personnel_id = ? AND users.id = specialist.personnel_id
    AND super_problem_type.id = problem.super_problem_type_id 
    AND sub_problem_type.id = problem.sub_problem_type_id
    AND problem.status = 0", [Auth::user()->id]);

    return $pendingSolution;
  }

  function fetchSolutionSuggestedProblems()
  {
    $solutionSuggested = DB::select("SELECT problem.id AS 'problem_id', 
    users.name AS 'specialist_name', 
    super_problem_type.name AS 'problem_type', 
    sub_problem_type.name AS 'title', 
    problem.status FROM problem, specialist, users,sub_problem_type, super_problem_type 
    WHERE specialist.id = problem.specialist_id AND problem.personnel_id = ? AND users.id = specialist.personnel_id
    AND super_problem_type.id = problem.super_problem_type_id 
    AND sub_problem_type.id = problem.sub_problem_type_id 
    AND problem.status = 1", [Auth::user()->id]);

    return $solutionSuggested;
  }

  function fetchSolvedProblems()
  {
    $solvedProblems = DB::select("SELECT problem.id AS 'problem_id', 
    users.name AS 'specialist_name', 
    super_problem_type.name AS 'problem_type', 
    sub_problem_type.name AS 'title', 
    problem.status FROM problem, specialist, users,sub_problem_type, super_problem_type 
    WHERE specialist.id = problem.specialist_id AND problem.personnel_id = ?  AND users.id = specialist.personnel_id
    AND super_problem_type.id = problem.super_problem_type_id 
    AND sub_problem_type.id = problem.sub_problem_type_id 
    AND problem.status = 2", [Auth::user()->id]);

    return $solvedProblems;
  }

  function fetchAutoSolvedProblems()
  {
    $autoSolvedProblems = DB::select("SELECT problem.id AS 'problem_id', 
    super_problem_type.name AS 'problem_type', 
    sub_problem_type.name AS 'title', 
    problem.status FROM problem, sub_problem_type, super_problem_type 
    WHERE problem.personnel_id = ?
    AND super_problem_type.id = problem.super_problem_type_id 
    AND sub_problem_type.id = problem.sub_problem_type_id 
    AND problem.specialist_id IS NULL
    AND problem.status = 2", [Auth::user()->id]);

    return $autoSolvedProblems;
  }

  function fetchSpecialistProblems()
  {
    $specialistProblems = DB::select("SELECT problem.id AS 'problem_id', 
    users.name AS 'specialist_name', 
    super_problem_type.name AS 'problem_type', 
    sub_problem_type.name AS 'title', 
    problem.status FROM problem, specialist, users, sub_problem_type, super_problem_type 
    WHERE users.id = ? AND specialist.personnel_id = users.id AND problem.specialist_id = specialist.id
    AND super_problem_type.id = problem.super_problem_type_id 
    AND sub_problem_type.id = problem.sub_problem_type_id
    AND problem.status = 0", [Auth::user()->id]);

    return $specialistProblems;
  }

  function fetchSpecialistPendingProblems()
  {
    $specialistProblems = DB::select("SELECT problem.id AS 'problem_id', 
    users.name AS 'specialist_name', 
    super_problem_type.name AS 'problem_type', 
    sub_problem_type.name AS 'title', 
    problem.status FROM problem, specialist, users, sub_problem_type, super_problem_type 
    WHERE users.id = ? AND specialist.personnel_id = users.id AND problem.specialist_id = specialist.id
    AND super_problem_type.id = problem.super_problem_type_id 
    AND sub_problem_type.id = problem.sub_problem_type_id
    AND problem.status = 1", [Auth::user()->id]);

    return $specialistProblems;
  }

  function fetchSpecialistSolvedProblems()
  {
    $specialistProblems = DB::select("SELECT problem.id AS 'problem_id', 
    users.name AS 'specialist_name', 
    super_problem_type.name AS 'problem_type', 
    sub_problem_type.name AS 'title', 
    problem.status FROM problem, specialist, users, sub_problem_type, super_problem_type 
    WHERE users.id = ? AND specialist.personnel_id = users.id AND problem.specialist_id = specialist.id
    AND super_problem_type.id = problem.super_problem_type_id 
    AND sub_problem_type.id = problem.sub_problem_type_id
    AND problem.status = 2", [Auth::user()->id]);

    return $specialistProblems;
  }
}
