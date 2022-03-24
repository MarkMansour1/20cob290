<?php

namespace App\Http\Controllers\users;

use DB;
use App\Http\Requests;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FetchReportProblemsStartUpInfo extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }
  public function index()
  {

    $superProblemType = $this->fetchSuperProblemType();
    $subProblemType = $this->fetchSubProblemType();
    $software = $this->fetchSoftware();
    $equipment = $this->fetchEquipment();

    return view('user.report-problem', ['superProblemType' => $superProblemType, 'subProblemType' => $subProblemType, 'software' => $software, 'equipment' => $equipment]);
  }

  function fetchSuperProblemType()
  {
    $superProblemType = DB::select("SELECT `id`,`name` FROM `super_problem_type`");
    return $superProblemType;
  }

  function fetchSubProblemType()
  {
    $subProblemType = DB::select("SELECT `super_type_id`,`id`,`name` FROM `sub_problem_type`");
    return $subProblemType;
  }

  function fetchSoftware()
  {
    $software = DB::select("SELECT `software` FROM `software`");

    return $software;
  }

  function fetchEquipment()
  {
    $equipment = DB::select("SELECT `serial_no`,`type`,`make` FROM `equipment` WHERE branch_id = ?", [Auth::user()->branch_id]);

    return $equipment;
  }
}
