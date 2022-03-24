<?php

namespace App\Http\Controllers\users;

use DB;
use App\Http\Requests;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FetchLookupEquipmentDetails extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
      $serialNo = $request->get('serialNo');
      $data = collect(\DB::select("SELECT equipment.serial_no, equipment.type, equipment.make, branch.city, branch.country, count(*) AS 'problemsReported' 
      FROM equipment, problem, branch 
      WHERE equipment.serial_no = ? AND equipment.serial_no = problem.serial_no 
      AND equipment.branch_id = branch.id 
      GROUP BY problem.serial_no, branch.id", [$serialNo]))->first();

      if($data === null) {
        $data = collect(\DB::select("SELECT equipment.serial_no, equipment.type, equipment.make, 
        branch.city, branch.country, 0 AS 'problemsReported' 
        FROM equipment, branch WHERE equipment.serial_no = 777 
        AND equipment.branch_id = branch.id", [$serialNo]))->first();
      }

      return ["data"=>$data];
      
    }   
}
