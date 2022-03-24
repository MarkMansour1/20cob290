<?php

namespace App\Http\Controllers\users;

use DB;
use App\Http\Requests;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FetchProblemDetails extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index($problem_id)
  {

    $problemDetails = $this->fetchProblemDetails($problem_id);
    $chatDetails = $this->fetchChatDetails($problem_id);
    $solution = $this->fetchSolution($problem_id);

    if (Auth::user()->job_title == 'specialist') {
      return view('user.specialist.problem', ['problemDetails' => $problemDetails, 'chatDetails' => $chatDetails, 'solution' => $solution]);
    } else {
      return view('user.problem', ['problemDetails' => $problemDetails, 'chatDetails' => $chatDetails, 'solution' => $solution]);
    }
  }

  function fetchProblemDetails($problem_id)
  {
    $problemDetails = collect(\DB::select("SELECT problem.id AS 'problem_id',
    problem.time_submitted AS 'creation_timestamp',
      problem.problem_description AS 'description',
      problem.software,
      equipment.make,
      equipment.type,
      problem.time_solved AS 'solution_time',
      users.name AS 'specialist_name', 
      super_problem_type.name AS 'problem_type', 
      sub_problem_type.name AS 'title', 
      problem.status FROM problem, specialist, users,sub_problem_type, super_problem_type , equipment
      WHERE specialist.id = problem.specialist_id AND users.id = specialist.personnel_id
      AND super_problem_type.id = problem.super_problem_type_id 
      AND sub_problem_type.id = problem.sub_problem_type_id 
      AND problem.serial_no = equipment.serial_no 
      AND problem.id = ?", [$problem_id]))->first();


    return $problemDetails;
  }

  function fetchChatDetails($problem_id)
  {
    $chat = DB::select("SELECT `created_at`,`personnel_chat`,`specialist_chat` 
    FROM `chat_box` 
    WHERE problem_id = ? 
    ORDER BY `created_at` desc", [$problem_id]);

    return $chat;
  }

  function fetchSolution($problem_id)
  {
    $solution = collect(\DB::select("SELECT solution.solution AS 'solution_title', 
    solution.solution_description 
    FROM solution, problem 
    WHERE problem.solution_id = solution.id 
    AND problem.id = ?", [$problem_id]))->first();

    return $solution;
  }
}
