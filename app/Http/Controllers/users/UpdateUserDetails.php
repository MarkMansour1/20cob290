<?php

namespace App\Http\Controllers\users;

use DB;
use App\Http\Requests;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UpdateUserDetails extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user_name = $request->get('name');
        $user_email = $request->get('email');
        $user_title = $request->get('title');
        $user_telephone = $request->get('telephone');
        $user_branch = $request->get('branch');
        $user_department = $request->get('department');

        $update_details = [
            'name' => $user_name,
            'email' => $user_email,
            'job_title' => $user_title,
            'telephone' => $user_telephone,
            'branch_id' => $user_branch,
            'department' => $user_department
        ];

        DB::table('users')
            ->where('id', Auth::user()->id)
            ->update($update_details);
    }
}
