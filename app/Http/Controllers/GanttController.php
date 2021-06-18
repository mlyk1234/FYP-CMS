<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GanttTask;
use App\Link;
use DB;

class GanttController extends Controller
{
    public function get(){

        $gt = new GanttTask();
        $links = new Link();
        
        return response()->json([
            "data" => $gt->get(),
            "links" => $links->all()
        ]);
        //$gantttasks = DB::table('gantttasks')->select('id','text','start_date','duration','progress')->get();
        
        //DB::table('gantttasks')->get();
        //return json_decode($gantttasks,true);
            //"links" => $links->all()
    }

    public function store(Request $request){
 
        $gt = new GanttTask();
 
        $gt->text = $request->text;
        $gt->start_date = $request->start_date;
        $gt->duration = $request->duration;
        $gt->progress = $request->has("progress") ? $request->progress : 0;
        $gt->parent = $request->parent;
 
        $gt->save();
 
        return response()->json([
            "action"=> "inserted",
            "tid" => $gt->id
        ]);
    }
    public function update($id, Request $request){
        $gt = GanttTask::find($id);
 
        $gt->text = $request->text;
        $gt->start_date = $request->start_date;
        $gt->duration = $request->duration;
        $gt->progress = $request->has("progress") ? $request->progress : 0;
        $gt->parent = $request->parent;
 
        $gt->save();
 
        return response()->json([
            "action"=> "updated"
        ]);
    }

    public function destroy($id){
        $gt = GanttTask::find($id);
        $gt->delete();
 
        return response()->json([
            "action"=> "deleted"
        ]);
    }
}
