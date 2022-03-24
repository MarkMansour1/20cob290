<?php

namespace App\Http\Controllers\users;

use DB;
use App\Http\Requests;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UpdateExpertise extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $specialist_id = DB::table('specialist')->where('personnel_id', [Auth::user()->id])->value('id');
        DB::table('expertise')->where('specialist_id', '=', $specialist_id)->delete();

        $expertise = $request->get('expertise');

        foreach ($expertise as $exp) {
            $exp = ['specialist_id' => $specialist_id, 'super_problem_type_id' => $exp];
            DB::table('expertise')->insert($exp);
        }
    }
}
