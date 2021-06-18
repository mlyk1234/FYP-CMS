<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Registration;

class RegisterController extends Controller
{
    //
    protected function register(Request $request)
    {
            return Registration::create([
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'uniqueid' => $request['uniqueid'],
                    'password' => Hash::make($request['password']),
                    'role' => $request['role']
                ]);
            
            //if($registered){
                //$accessToken = Auth::user()->createToken('authToken')->accessToken;
                
                //return response(['user' => Auth::user(), 'accessToken' => $accessToken]);
           // }
    }

    public function check(Request $request)
    {
        //$check = Registration::where('email',$request->email)->get();

        if(Registration::where('email','=',$request->email)->select('email')->first()){
            return $is_available = '1';
        }else{
            return $is_available = '0';
        }
    }
        
}

