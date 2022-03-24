<?php

namespace App\Http\Controllers\users;

use DB;
use App\Http\Requests;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FetchSettings extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $details = $this->fetchUserDetails();
        $branches = $this->fetchBranches();

        if (Auth::user()->job_title == 'specialist') {
            $availability = $this->fetchAvailability();
            $expertise = $this->fetchExpertise();
            $userExpertise = $this->fetchUserExpertise();

            return
                view('user.settings', ['details' => $details, 'branches' => $branches, 'availability' => $availability, 'expertise' => $expertise, 'userExpertise' => $userExpertise]);
        } else {

            return view('user.settings', ['details' => $details, 'branches' => $branches]);
        }
    }

    function fetchUserDetails()
    {
        $userDetails = DB::select("SELECT name, email, job_title, telephone, branch_id, department FROM users WHERE id = ?", [Auth::user()->id]);

        return $userDetails;
    }


    function fetchAvailability()
    {
        $availability = DB::table('specialist')->where('personnel_id', [Auth::user()->id])->value('status');

        return $availability;
    }

    function fetchExpertise()
    {
        $expertise = DB::select("SELECT id, name FROM super_problem_type");

        return $expertise;
    }

    function fetchUserExpertise()
    {
        $userExpertise = DB::select(
            "SELECT expertise.super_problem_type_id
            FROM expertise, specialist
            WHERE specialist.personnel_id = ?
            AND expertise.specialist_id = specialist.id",
            [Auth::user()->id]
        );

        return $userExpertise;
    }

    function fetchBranches()
    {
        $branches = DB::select("SELECT id, name FROM branch");

        return $branches;
    }
}
