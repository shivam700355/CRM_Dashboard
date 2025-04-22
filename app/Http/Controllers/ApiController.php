<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vertical;


class ApiController extends Controller
{
    //

    public function index(){
        return "UPICON Dashboard API";
    }

    public function getVerticals(){
        $verticals = Vertical::all();
        return response()->json($verticals);
    }
    
}
