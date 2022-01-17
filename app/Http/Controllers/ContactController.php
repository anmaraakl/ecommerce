<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    function showcontact(){
        return view('contactus');
    }

    public function send(Request $request){
        $name=$request->name;
        $email=$request->email;
        $messege=$request->messege;
         Mail::to("ss@ss.com")
    ->send(new ContactMail($name,$email,$messege));
    return redirect()->back();
     }

}





