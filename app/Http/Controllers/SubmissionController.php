<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Submission;
use App\User;
use DB;
use GuzzleHttp\Client;

class SubmissionController extends Controller
{

    public function listing()
    {
        $client = new Client;
        $request = $client->get('192.168.126.150/api/submissiontype');
        $response = $request->getBody();

        return $response;
        dd($response);
    }

    public function remarksupervisor($userid, $chaptername)
    {
        return Submission::where('userid', $userid)->where('chapter', $chaptername)->update([
                    'remarks1' => "true",
                ]);
    }
    public function remarkexaminer($userid, $chaptername)
    {
        return Submission::where('userid', $userid)->where('chapter', $chaptername)->update([
                    'remarks2' => "true",
                ]);
    }
    public function list(Request $request)
    {

        return DB::table('projectdata AS p')->where('p.supervisor', Auth::user()->id)->leftJoin('submission AS s','s.userid','=','p.studentid')
                ->leftJoin('users AS u', 'u.id','=', 'p.studentid')->groupBy('u.id')->get();

    }

    public function listdownload($userid)
    {
        return DB::table('projectdata AS p')->where('p.supervisor', Auth::user()->id)->where('p.studentid',$userid)->leftJoin('submission AS s','s.userid','=','p.studentid')
                ->groupBy('s.chapter')->get();
    }

    public function list2(Request $request)
    {
        return DB::table('projectdata AS p')->where('p.examiner', Auth::user()->id)->leftJoin('submission AS s','s.userid','=','p.studentid')
                ->leftJoin('users AS u', 'u.id','=', 'p.studentid')->groupBy('u.id')->get();
    }
    public function listdownload2($userid)
    {
        return DB::table('projectdata AS p')->where('p.examiner', Auth::user()->id)->where('p.studentid',$userid)->leftJoin('submission AS s','s.userid','=','p.studentid')
                ->groupBy('s.chapter')->get();
    }
    public function upload(Request $request){


        if(is_null(Submission::where('userid', Auth::user()->id)->where('chapter', '=', $request->c )->first()))
        {
            $Submisson = new Submission;

            if($request->file())
            {
                $file_name = time().'_'.$request->file->getClientOriginalName();
                $test = $request->c;
                $file_path = $request->file('file')->storeAs("uploads/".Auth::user()->id."/".$test, $file_name, "public");
                
                $Submisson->userid = Auth::user()->id;
                $Submisson->chapterid = $request->cid;
                $Submisson->chapter = $request->c;
                $Submisson->submission_title = time().'_'.$request->file->getClientOriginalName();
                $Submisson->file_path = '/storage/' . $file_path;
                $Submisson->save();

                return response()->json(['success'=>'File uploaded successfully.']);
            }
        } else if (!is_null(Submission::where('userid', Auth::user()->id)->where('id', $request->id)->first()) ){
            $file_name = time().'_'.$request->file->getClientOriginalName();
            $test = $request->c;
            $file_path = $request->file('file')->storeAs("uploads/".Auth::user()->id."/".$test, $file_name, "public");

            Submission::where('userid', Auth::user()->id)->where('id', $request->id)->update([
                'chapter' => $request->c,
                'submission_title' => time().'_'.$request->file->getClientOriginalName(),
                'file_path' => '/storage/' . $file_path,
            ]);

            return response()->json([
                "action"=> "file updated",
            ]);
        }

    }    
    
    public function search($chapter)
    {
        if(is_null(Submission::where('chapter', $chapter)->where('userid', Auth::user()->id)->first()))
        {
            $none = 1;
            return $none;
        } else {    
            $test = Submission::where('chapter', $chapter)->where('userid', Auth::user()->id)->get();
            return $test;
        }


        //return Submission::all();
    }

    public function download(Request $request)
    {
        $path = Submission::where('userid', Auth::user()->id)->get();
        $url = "localhost:8000/".$path;
        //return Submission::all();
        return $path;
    }

    public function uploader(Request $request)
    {
        $image = '';

        if(isset($_FILES['file']['name']))
        {
            $image_name = $_FILES['file']['name'];
            $valid_extensions = array("jpg","jpeg","png");
            $extension = pathinfo($image_name, PATHINFO_EXTENSION);
            if(in_array($extension, $valid_extensions))
            {
                $upload_path = 'images/' . time() . '.' . $extension;
                if(move_uploaded_file($_FILES['file']['tmp_name'], $upload_path)){
                    $message = "Image UPLOADED";
                    $image = $upload_path;
                }else{
                    $message = 'Select Image';
                }
                $output = array(
                    'message' => $message,
                    'image' => $image
                );

                echo json_encode($output);
            }else {
                $message = 'Only IMAGE PLEASE';
            }
        }
    }
}
