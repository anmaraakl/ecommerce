<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class LangController extends Controller
{
  public  function swap ($local){
        Session::put('local',$local);
        return redirect()->back();
    }
}
