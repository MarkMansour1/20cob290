<?php

namespace App\Http\Controllers\users;

use DB;
use App\Http\Requests;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UpdateAvailability extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $status = $request->get('status');

        DB::table('specialist')
            ->where('personnel_id', Auth::user()->id)
            ->update(['status' => $status]);
    }
}
