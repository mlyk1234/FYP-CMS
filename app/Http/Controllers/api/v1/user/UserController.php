<?php

namespace App\Http\Controllers\api\v1\user;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Admin;
use App\Projectdata;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$user = request()->user()->user;

        //return User::collection($user);
        return User::all();
        //return User::paginate();
        //
    }

    public function getProfile()
    {
        return User::leftJoin('projectdata AS p', 'p.studentid','=', 'users.id')
        ->leftJoin('users as s', 's.id','=','p.supervisor')
        ->leftJoin('users as e', 'e.id','=','p.examiner')
        ->select('users.*','p.*','s.name AS supervisorname','e.name AS examinername')->where('users.id', Auth::user()->id)->get();
    }



    public function editProfile(Request $request)
    {
        User::where('id', Auth::user()->id)->update([
            'name' => $request->name,
            'uniqueid' => $request->uniqueid,
            'email' => $request->email,
            'major' => $request->major,
        ]);
        return response()->json([
            "action"=> "updated",
        ]);
    }

    public function collective()
    {
        //$user = request()->user()->user;

        //return User::collection($user);
        //return DB::table('users')->where('id','=','21')->get('id'); 
        return User::where('role', 1)->leftJoin('projectdata', 'users.id', '=', 'projectdata.studentid')->get();  //for all of one user
        //return Admin::where('supervisor', Auth::user()->id)->leftJoin('users', 'projectdata.studentid', '=', 'users.id')->get();

        //return User::paginate();
        //
    }

    public function currentUser() {
        return Auth::user();
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
