<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Projectdata;
use App\User;
use Illuminate\Support\Facades\Auth;
use DB;
class ProjectdataController extends Controller
{
    public function get()
    {
        //return DB::table('projectdata')->leftJoin('users', 'projectdata.studentid', '=', 'users.id' )
        //->where('projectdata.studentid', Auth::user()->id)->get();
    	return Projectdata::select('p.name AS supervisorname','projectdata.*')->leftJoin('users AS u','u.id','=', 'studentid')->join('users AS p','supervisor','=','p.id')->where('studentid', Auth::user()->id)->get();
    }

    public function getFlag()
    {
        //return DB::table('projectdata')->leftJoin('users', 'projectdata.studentid', '=', 'users.id' )
        //->where('projectdata.studentid', Auth::user()->id)->get();
        $flag = 0;
        $checkif = Projectdata::where('studentid', Auth::user()->id)->get('flag');
        if($checkif->isEmpty())
        {
            return $flag;
        } else {
            $flag = 1;
            return $flag;
        }
    }

    public function fillsupervisor(){
        return User::select('id','name')->where('role',2)->get();
    }
    public function save(Request $request){

        if(is_null(Projectdata::where('studentid', '=', Auth::user()->id)->first()))
        {
            $project = new Projectdata();
            //$project = GanttTask::find($id);

            $project->studentid = Auth::user()->id;
            $project->project_title = $request->project_title;
            $project->basic_skill = $request->basic_skill;
            $project->problem_statement = $request->problem_statement;
            $project->objective = $request->objective;
            $project->project_outcome = $request->project_outcome;
            $project->project_description = $request->project_description;
            $project->supervisor = $request->supervisor;
            //$project->examiner = $request->examiner;

            $project->save();
    
            return response()->json([
                "action"=> "inserted",
                "tid" => $project->id
            ]);
        } else {
            Projectdata::where('studentid', Auth::user()->id)->update([
                'project_title' => $request->project_title,
                'basic_skill' => $request->basic_skill,
                'problem_statement' => $request->problem_statement,
                'objective' => $request->objective,
                'project_outcome' => $request->project_outcome,
                'project_description' => $request->project_description,
                'supervisor' => $request->supervisor,
            ]);
     
            return response()->json([
                "action"=> "updated",
            ]);
        }
    }
}
