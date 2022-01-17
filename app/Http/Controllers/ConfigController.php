<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Mail\ConfigMail;
use App\TokenMail;
use Carbon\Carbon;
use App\User;


class ConfigController extends Controller
{
    public function showconfig(){
        return view('configAccount');
       }
    public function config(){
        // dd($_GET['token']);
        $token=$_GET['token'];
        $email=$_GET['email'];

        $token_mail = TokenMail::where([['mail',$email],['token',$token]])->first();

        // dd($token_mail);
        // $mail= TokenMail($token,$email);
        if($token_mail){
            if($token_mail->mail == auth()->user()->email){
                $user = auth()->user();
                // dd($user);
                $user1 = User::find($user->id);
                $user1->email_verified_at=Carbon::now();
                // $user->email_verified_at='2022';
                $user1->save();
                return redirect()->route('home');
            } else return redirect()->back();

        } else redirect()->back();
    }

}
