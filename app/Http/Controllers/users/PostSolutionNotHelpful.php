<?php

namespace App\Http\Controllers\users;

use DB;
use App\Http\Requests;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostSolutionNotHelpful extends Controller
{

  public function __construct() {
    $this->middleware('auth');
  }

  public function index(Request $request) {
    $message = $request->get('message');
    $problemID = $request->get('problemId');
    $creationTime = $request->get('creationTime');

    $this->updateMessage($message, $problemID, $creationTime);
    $this->removeSolution($problemID);

  }

  function updateMessage($message, $problemID, $creationTime) {
    
    DB::insert("INSERT INTO `chat_box` 
    (`id`, `problem_id`, `created_at`, `updated_at`, `personnel_chat`, `specialist_chat`) 
    VALUES (NULL, ?, ?, NULL, NULL, ?)",[$problemID,$creationTime,$message]);
  }

  function removeSolution($problemID) {

    DB::update("UPDATE problem SET status = 0, solution_id = NULL, time_solved = NULL WHERE problem.id = ?",[$problemID]);
  }

}