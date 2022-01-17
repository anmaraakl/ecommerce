<?php

namespace App\Http\Controllers;

use App\Mail\ForgetPass;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class ForgetPassController extends Controller
{
    public function showRessetPassword(){
        return view('showRessetPassword');
    }

    public function ressetpass(Request $request){
        $email = User::where('email',$request->email)->first();
        if($email){
            $token = $this->index();
            DB::table('password_resets')->insert(["email"=>$email->email,"token"=>$token]);
            Mail::to($email)->send(new ForgetPass($token,$email->email) );
            return redirect()->back();
        }
    }

    public function passres(){
       
        $token=$_GET['token'];
        $email=$_GET['email'];

        $reset = DB::table('password_resets')->where(["email"=>$email,"token"=>$token])->first();
         if($reset) {
             return view('/resetPassword');
         }  
    }

    public function reset(Request $request){
         $user = User::where('email',$request->email)->first();
        // //  $user1 =User::find($user->id);
         $user->password=Hash::make($request->newPass);
         $user->save();
         return redirect('home');
    }

    public function index(){
        return $token=Str::random(10);
     }
}
