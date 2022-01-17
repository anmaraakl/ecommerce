<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User; //model database
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\storage;

use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //middleware gust and auth (PROTECTION): 
    public function __construct()
    {
        $this->middleware('auth');
    }
    //////////////////////////////////////////////////////////
    // my information
    public function myInfo()
    {
        $user = auth()->user();
        // dd($user);
        return view('users.myInfo')->with('user', $user);
    }
    //////////////////////////////////////////////////////////
    // update information  
    public function showUpdateInfo()
    {
        $user = auth()->user();
        return view('users.showUpdateInfo')->with('user', $user);
    }
    //////////////////////////////////////////////////////////
    public function upateinformation(Request $request)
    {
       
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|min:6'
        ]);
        $user = auth()->user();
        $user1 = User::find($user->id);
        $user1->name = $request->name;
        $user1->email = $request->email;
        if ($request->hasFile('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // FileName to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload Image
            $path = $request->file('image')->storeAs('public/users_images', $fileNameToStore);
            $user1->image = $fileNameToStore;
             } else {
            $fileNameToStore = 'noimage.png';
             }
            $user1->image = $fileNameToStore;
        $user1->save();
        return redirect('/myInfo')->with('success', 'your information updated');
    }
    //////////////////////////////////////////////////////////
    public function showChangePassword()
    {
        $user = auth()->user();
        if ($user != null)
            return view('users.showChangePassword');
    }
    //////////////////////////////////////////////////////////
    public function ChangePassword(Request $request)
    {
        $this->validate($request, [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6'
        ]);
        $user = auth()->user();
        $user1 = User::find($user->id);
        // dd(Hash::check($request->oldPassword , $user1->password ,$request->oldPassword));
        // Hash::check($request->oldPassword , $user1->password);
        if (Hash::check($request->oldPassword, $user1->password)) {
            $user1->password = Hash::make($request->newPassword);
            $user1->save();
            return redirect('/myInfo');
        }
        return redirect()->back()->with('error', 'your old password is wrong');
    }
    //////////////////////////////////////////////////////////
    public function AllUsers()
    {

        $user = Auth::user();
        if ($user->role == "admin") {
            //all users in database: $users=User::all();
            $users = User::where('role', 'user')->get(); //all users in database where role is user
            // dd($users);
            return view('users.users')->with('AllUsers', $users); //AllUsers is the name who can used in the view page
        }
        return redirect()->back();
    }
    //////////////////////////////////////////////////////////
    public function deleteUser($id)
    {
        $user1 = Auth::user();
        if ($user1->role == "admin") {
            $user = User::where('id', $id)->first();
            //  $user=User::find($id);
            $user->delete();
            return redirect('/users')->with('success', 'user deleted');
        }
        return redirect()->back();
    }
    //////////////////////////////////////////////////////////
    public function upgradeUser($id)
    {
        $user1 = Auth::user();
        if ($user1->role == "admin") {
            $user = User::where('id', $id)->first();
            //  $user=User::find($id);
            $user->role = "admin";
            $user->save();
            return redirect('/users')->with('success', 'user upgrade');
        }
        return redirect()->back();
    }
    //////////////////////////////////////////////////////////
    public function showUpdateUser($id)
    {
        $user1 = Auth::user();
        if ($user1->role == "admin") {
            $userInfo = User::where('id', $id)->first();
            return view('users.showUpdate')->with('userInfo', $userInfo);
        }
        return redirect()->back();
    }
    //////////////////////////////////////////////////////////
    public function update(Request $request){
    //    dd($request);
    $this->validate($request, [
        'name' => 'required|min:3'
    ]);
        $user = User::where('id', $request->id)->first();
        // $user1 = User::find($user->id);
        $user->name =$request->name;
        $user->email=$request->email;
        if ($request->hasFile('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // FileName to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload Image
            $path = $request->file('image')->storeAs('public/users_images', $fileNameToStore);
            $user->image = $fileNameToStore;
             } else {
            $fileNameToStore = 'noimage.png';
             }
            $user->image = $fileNameToStore;
        $user->save();
        return redirect('/users')->with('success', 'user information updated');
    }
    //////////////////////////////////////////////////////////
    public function showadduser(){
        return view('users.showadduser');
    /////////////////////////////////////////////////////////
    }
    public function adduser(Request $request){
        $user=new User;
        if( $request->password == $request->Confirm_Password){

            $user->name=$request->name;
            $user->email=$request->email;
            $user->role='user';
            $user->password=Hash::make($request->password);
    
            if ($request->hasFile('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // FileName to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload Image
            $path = $request->file('image')->storeAs('public/users_images', $fileNameToStore);
            $user->image = $fileNameToStore;
             } else {
            $fileNameToStore = 'noimage.png';
             }
            $user->image = $fileNameToStore;
            $user->save();
            return redirect('/users')->with('success', 'user is add');
        } else return redirect()->back()->with('error', 'your password is not Confirmed');
       
        
    }

}
