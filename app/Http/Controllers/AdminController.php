<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Admin;
use App\User;
use DB;

class AdminController extends Controller
{
    public function supervised(Request $request)
    {
        return Admin::where('supervisor', Auth::user()->id)->leftJoin('users AS u', 'projectdata.studentid', '=', 'u.id')->leftJoin('users AS s', 's.id', '=', 'projectdata.examiner')->get(['s.name AS examinername','projectdata.*','u.*']);
    }

    public function examined(Request $request)
    {
        // LEFT JOIN AND SELF JOIN
        return Admin::where('examiner', Auth::user()->id)->leftJoin('users AS u', 'projectdata.studentid', '=', 'u.id')->leftJoin('users AS s', 's.id', '=', 'projectdata.supervisor')->get(['s.name AS supervisorname','projectdata.*','u.*']);
    }

    public function examine($index){
        Admin::where('studentid', $index)->update([
            'examiner' => Auth::user()->id,
        ]);
    
        return response()->json([
            "action"=> "updated",
        ]);
    }

}
