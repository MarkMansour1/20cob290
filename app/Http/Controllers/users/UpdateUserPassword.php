<?php

namespace App\Http\Controllers\users;

use DB;
use App\Http\Requests;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UpdateUserPassword extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $new_password = Hash::make($request->get('newpassword'));
        // $new_password = $request->get('newpassword');

        DB::table('users')
            ->where('id', Auth::user()->id)
            ->update(['password' => $new_password]);
    }
}
