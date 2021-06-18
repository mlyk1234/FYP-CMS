<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GanttTask;

class GanttTaskController extends Controller
{
    public function store(Request $request){
 
        $gantttasks = new GanttTask();
 
        $gantttasks->text = $request->text;
        $gantttasks->start_date = $request->start_date;
        $gantttasks->duration = $request->duration;
        $gantttasks->progress = $request->has("progress") ? $request->progress : 0;
        $gantttasks->parent = $request->parent;
 
        $gantttasks->save();
 
        return response()->json([
            "action"=> "inserted",
            "tid" => $gantttasks->id
        ]);
    }

    public function update($id, Request $request){
        $gantttasks = GanttTask::find($id);
 
        $gantttasks->text = $request->text;
        $gantttasks->start_date = $request->start_date;
        $gantttasks->duration = $request->duration;
        $gantttasks->progress = $request->has("progress") ? $request->progress : 0;
        $gantttasks->parent = $request->parent;
 
        $gantttasks->save();
 
        return response()->json([
            "action"=> "updated"
        ]);
    }

    public function destroy($id){
        $gantttasks = GanttTask::find($id);
        $gantttasks->delete();
 
        return response()->json([
            "action"=> "deleted"
        ]);
    }
}
