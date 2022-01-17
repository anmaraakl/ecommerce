<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function myProduct(){
       $user=Auth::User();
       $products=Product::where('user_id',$user->id)->get();
       return view('products.myProducts',['products'=>$products]);
                   // from view


    }

    public function assignto($id){
        $user=Auth::user();
        if($user->role=='admin'){
        // $users=User::where('role','user')->get();
        $users=User::all();
        $product=Product::find($id);
        return view('admin.assignto')->with('users',$users)->with('product',$product);
        }

    }

    public function assign(Request $request){
        $user=Auth::user();
        if($user->role=='admin'){
        $product=Product::find($request->product_id);
        $product->user_id=$request->user_id;
        $product->save();
        return redirect('/products');
        }
    }

}
