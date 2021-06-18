<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Admin;
use App\User;
use DB;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    public function userlist(Request $request)
    {
        $client = new Client;
        $request = $client->get('192.168.126.150/api/list');
        $response = $request->getBody();

        return $response;
        dd($response);
    }
    
}
