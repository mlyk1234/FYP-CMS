<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Simple;

class SimpleController extends Controller
{

    public function get()
    {
    	return Simple::all();
    }

    public function save(Request $request){

        if(is_null(Simple::where('studentid', '=', Auth::user()->id)->first()))
        {
            $simple = new Simple;

            $simple->studentid = Auth::user()->id;
            $simple->title = $request->title;
    
            $simple->save();
     
            return response()->json([
                "action"=> "inserted",
            ]);
        } else {
            Simple::where('studentid', Auth::user()->id)->update([
                'title' => $request->title
            ]);
     
            return response()->json([
                "action"=> "updated",
            ]);
        }

    }
}
