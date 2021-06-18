<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Evaluate;
use App\EvaluateFinal;
use App\EvaluateMarkingForExaminer;
use Illuminate\Http\Request;
use DB;
use GuzzleHttp\Client;

class EvaluationControllerExamine extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function submitmarking($studentid, $mark)
    {
        if(is_null(EvaluateFinal::where('studentid', $studentid)->first()))
        {
            $submit = new EvaluateFinal();
            //$project = GanttTask::find($id);
            $submit->studentid = $studentid;
            $submit->mark2 = $mark;
            $submit->examinerid = Auth::user()->id;
            //$submit->total += $marks;
            //$project->examiner = $request->examiner;
            $submit->save();

            return response()->json([
                "action"=> "inserted"
            ]);
        } else {
            EvaluateFinal::where('studentid', $studentid)
            ->update([
                'mark2' => $mark,
            ]);
     
            return response()->json([
                "action"=> "updated",
            ]);
        }

    }

    public function savedmarking($parent,$studentid)
    {
        $get = EvaluateMarkingForExaminer::where('evaluationmarkingid',$parent)->where('studentid',$studentid)
        ->select('marksgiven')->get();
        $get = json_decode($get,true);
        $data = "";
        foreach($get as $row)
        $data = $row['marksgiven'];
        
        return $data;
    }
    public function total($studentid)
    {
        $data = EvaluateMarkingForExaminer::where('studentid',$studentid)->select('marksgiven')->get();
        $total = 0;
        foreach($data as $row)
        {
            $total += $row['marksgiven'];
        }
        return $total;
    }

    public function finalmarking($parent, $studentid, $marks)
    {
        if(is_null(EvaluateMarkingForExaminer::where('evaluationmarkingid', $parent)->where('studentid', $studentid)->first()))
        {
            $project = new EvaluateMarkingForExaminer();
            //$project = GanttTask::find($id);

            $project->evaluationmarkingid = $parent;
            $project->studentid = $studentid;
            $project->examinerid= Auth::user()->id;
            $project->marksgiven= $marks;
            //$project->examiner = $request->examiner;

            $project->save();

            return response()->json([
                "action"=> "inserted"
            ]);
        } else {
            EvaluateMarkingForExaminer::where('evaluationmarkingid', $parent)->where('studentid', $studentid)
            ->update([
                'marksgiven' => $marks,
            ]);
     
            return response()->json([
                "action"=> "updated",
            ]);
        }
    }  


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function show(c $c)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function edit(c $c)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, c $c)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function destroy(c $c)
    {
        //
    }
}
