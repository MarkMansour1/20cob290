<?php

namespace App\Http\Controllers\users;

use DB;
use App\Http\Requests;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostChatMessage extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(Request $request)
  {
    $message = $request->get('message');
    $problemID = $request->get('problemId');
    $creationTime = $request->get('creationTime');

    if (Auth::user()->job_title == 'specialist') {
      DB::insert("INSERT INTO `chat_box` 
    (`id`, `problem_id`, `created_at`, `updated_at`, `personnel_chat`, `specialist_chat`) 
    VALUES (NULL, ?, ?, NULL, NULL, ?)", [$problemID, $creationTime, $message]);
    } else {
      DB::insert("INSERT INTO `chat_box` 
    (`id`, `problem_id`, `created_at`, `updated_at`, `personnel_chat`, `specialist_chat`) 
    VALUES (NULL, ?, ?, NULL, ?, NULL)", [$problemID, $creationTime, $message]);
    }
  }
}
