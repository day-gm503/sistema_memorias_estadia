<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public  function index()
    {
        $var = rand(1,100);
        return view('admin')->
            with('numero',$var);
    }
}
