<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Admin;
use App\User;
use App\Submission;
use DB;
use GuzzleHttp\Client;

class DashboardController extends Controller
{
    public function treemap()
    {
        $client = new Client;
        $request = $client->get('192.168.126.150/api/treemap');
        $response = $request->getBody();

        return $response;
        dd($response);
    }

    public function submitted(Request $request)
    {
        return Submission::selectRaw('count(chapter) AS count, chapter')->where('userid', Auth::user()->id)->groupBy('chapter')->get();
    }

    public function loopsupervise()
    {
        $test = DB::table('users AS u')->leftJoin('projectdata AS p', 'p.studentid', '=', 'u.id')
        ->where('p.supervisor', Auth::user()->id)->get();
        return $test;
    }
    public function loopexamine()
    {
        $test = DB::table('users AS u')->leftJoin('projectdata AS p', 'p.studentid', '=', 'u.id')
        ->where('p.examiner', Auth::user()->id)->get();
        return $test;
    }
    public function superviseprogress(Request $request)
    {
        return DB::table('submission AS s')->rightJoin('projectdata AS p', 's.userid','=', 'p.studentid')
        ->leftJoin('submissiontype AS t', 't.id', '=', 's.chapterid')
        ->where('p.supervisor', Auth::user()->id)->groupBy('p.studentid')
        ->select('p.studentid')->selectRaw('count(s.chapterid) as count')->get();
    }
    public function examineprogress(Request $request)
    {
        return DB::table('submission AS s')->rightJoin('projectdata AS p', 's.userid','=', 'p.studentid')
        ->leftJoin('submissiontype AS t', 't.id', '=', 's.chapterid')
        ->where('p.examiner', Auth::user()->id)->groupBy('p.studentid')
        ->select('p.studentid')->selectRaw('count(s.chapterid) as count')->get();
    }
    public function fyp2(Request $request)
    {
        return DB::table('submission AS s')->rightJoin('projectdata AS p', 's.userid','=', 'p.studentid')
        ->leftJoin('submissiontype AS t', 't.id', '=', 's.chapterid')
        ->where('p.supervisor','8')->where(function($q){
            $q->where('t.period','2')->orWhereNull('t.period');})->groupBy('p.studentid','t.period')
        ->select('p.studentid')->selectRaw('count(s.chapterid) as count')->selectRaw('IFNULL(t.period,1) as period')->get();
    }

    public function who(Request $request)
    {
        $test =  DB::table('submissiontype AS t')->select('t.id','u.uniqueid')->selectRaw('count(s.chapter) AS submitted')
        ->join('submission AS s', 't.id','=','s.chapterid')
        ->leftJoin('projectdata AS p', 'p.studentid','=','s.userid')
        ->leftJoin('users AS u', 's.userid','=','u.id')
        ->where('p.supervisor', 8)->groupBy('t.id','u.uniqueid')->get();    

        $test = json_decode($test,true);
        $data = array();
        $count = 0;

        foreach($test as $row){
            $data[] = array( $row['id'], $row['uniqueid'], $row['submitted']);
        }
        $datas = [[0,3,1],[0,3,1],[0,4,1],[2,0,1]];
        //echo '<pre>';
        return json_encode($data);
        //echo '</pre>';
    }

    public function submittednew(Request $request)
    {
        return DB::table('submissiontype AS t')->select('t.name')->selectRaw('count(s.chapterid) AS count')
        ->leftJoin('submission AS s', function($join)
        {
            $join->on('s.chapterid', '=', 't.id');
            $join->where('s.userid','=',Auth::user()->id);
        })->groupBy('t.name','t.id')->orderBy('t.id','ASC')->get();
    }

    public function groupbycategory(Request $request)
    {
        $data1 = DB::table('projectdata')->where('supervisor', Auth::user()->id)->selectRaw('count(projectdata.studentid) AS count1')->groupBy('projectdata.supervisor')->get();
        if(sizeof($data1)==NULL)
        {   
            $data1[]= array('count1'=>0);
        }
        $data2 = DB::table('projectdata')->where('examiner', Auth::user()->id)->selectRaw('count(projectdata.studentid) AS count2')->groupBy('projectdata.examiner')->get();
        if(sizeof($data2)==NULL)
        {   
            $data2[]= array('count2'=>0);
        }        
        
        $merged = $data1->merge($data2);
        $merged = json_decode($merged, true);
        
        $data = array();
        $data = array($merged[0]['count1'], $merged[1]['count2']);
        
        //$reserved = $merged->all();
        
        return $data;
        //return json_encode(array_values($reserved));
    }


    public function supervised(Request $request)
    {
        return Admin::where('supervisor', Auth::user()->id)->leftJoin('users', 'projectdata.studentid', '=', 'users.id')->get();
    }

    public function supervise(Request $request)
    {
        
        // LEFT JOIN AND SELF JOIN
        //return Admin::where('examiner', Auth::user()->id)->leftJoin('users AS u', 'projectdata.studentid', '=', 'u.id')->get(['u.name'])->toJson();
        //return DB::table('projectdata AS p')->leftJoin('users AS u', 'u.id', '=', 'p.studentid')->where('p.examiner', '=', Auth::user()->id )->select('u.*','p.*')->get();
        return DB::table('projectdata AS p')->leftJoin('users AS u', 'u.id', '=', 'p.studentid')->leftJoin('submission AS s', 'p.studentid','=','s.userid')->where('p.supervisor', '=', Auth::user()->id )->select('u.*','p.*')->selectRaw('count(s.chapter) AS counter')->groupBy('p.studentid')->orderBy('p.id', 'ASC')->get();

        //return Admin::where('examiner', '8')->leftJoin('users AS u', 'projectdata.studentid', '=', 'u.id')->select('users.*','projectdata.*')->get();
        //return Admin::where('examiner', '8')->get();
    }

    public function supervisez(Request $request)
    {
        
        // LEFT JOIN AND SELF JOIN
        //return Admin::where('examiner', Auth::user()->id)->leftJoin('users AS u', 'projectdata.studentid', '=', 'u.id')->get(['u.name'])->toJson();
        //return DB::table('projectdata AS p')->leftJoin('users AS u', 'u.id', '=', 'p.studentid')->where('p.examiner', '=', Auth::user()->id )->select('u.*','p.*')->get();
        return DB::table('projectdata AS p')->leftJoin('users AS u', 'u.id', '=', 'p.studentid')->leftJoin('submission AS s', 'p.studentid','=','s.userid')->where('p.supervisor', '=', Auth::user()->id )->select('u.*','p.*')->selectRaw('count(s.chapter) AS counter')->groupBy('p.studentid')->orderBy('p.id', 'ASC')->get();

        //return Admin::where('examiner', '8')->leftJoin('users AS u', 'projectdata.studentid', '=', 'u.id')->select('users.*','projectdata.*')->get();
        //return Admin::where('examiner', '8')->get();
    }

    public function examining(Request $request)
    {
        
        // LEFT JOIN AND SELF JOIN
        //return Admin::where('examiner', Auth::user()->id)->leftJoin('users AS u', 'projectdata.studentid', '=', 'u.id')->get(['u.name'])->toJson();
        //return DB::table('projectdata AS p')->leftJoin('users AS u', 'u.id', '=', 'p.studentid')->where('p.examiner', '=', Auth::user()->id )->select('u.*','p.*')->get();
        return DB::table('projectdata AS p')->leftJoin('users AS u', 'u.id', '=', 'p.studentid')->leftJoin('submission AS s', 'p.studentid','=','s.userid')->where('p.examiner', '=', Auth::user()->id )->select('u.*','p.*')->selectRaw('count(s.chapter) AS counter')->groupBy('p.studentid')->get();

        //return Admin::where('examiner', '8')->leftJoin('users AS u', 'projectdata.studentid', '=', 'u.id')->select('users.*','projectdata.*')->get();
        //return Admin::where('examiner', '8')->get();
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
