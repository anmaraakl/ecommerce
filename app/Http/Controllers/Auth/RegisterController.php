<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ConfigMail;
use App\Providers\RouteServiceProvider;
use App\TokenMail;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $user=new User;

        $token=new TokenMail;
        $token->token=$this->index();

        $token->mail =$data['email'];
        $token->save();
        $user->name=$data['name'];
        Mail::to($data['email'])
        ->send(new ConfigMail($token->token,$data['email']));



        if(preg_match('/@/i',$data['email']) ){
            $user->email=$data['email'];
        }
        else{
            $user->phone=$data['email'];
            $user->email=$data['email'];
        }
        $user->role='user';
        $user->password=Hash::make($data['password']);
        $user->image='';
        $user->save();
         return $user;
    }

    public function index(){
       return $token=Str::random(10);
    }

}
