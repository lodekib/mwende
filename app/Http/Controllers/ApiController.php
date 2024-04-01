<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getData(Request $request)
    {


        $response = file_get_contents($request);
        $data = json_decode($response);

        dump($data);

        return response()->json($data);
    }
}
