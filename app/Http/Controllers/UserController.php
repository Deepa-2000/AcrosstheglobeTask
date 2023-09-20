<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    // public function __construct()
    // {
        // $this->middleware('auth');
    // }
    public function index(){

        return view('register');

    }

    public function loginpage(){

        return view('login');
        
    }
    public function login(Request $request){

        $request->validate([
            'email'=> 'required',
            'password'=> 'required',
        ]);
        $cred=$request->only('email','password');
        if (Auth::attempt($cred)) {
            Session::flash('success','You Have Successfully Logged In..!');
            return redirect()->intended('dashboard');
        }
        Session::flash('error','Login details are not valid..!');
        return redirect('login');
    }
    public function register(Request $request){
        
        $request->validate([
            'name'=> 'required|regex:/^[a-zA-Z]+$/u|max:255',
            'email'=> 'required|regex:/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/|unique:users',
            'password'=> 'required|string|min:8'
        ]);
        
        $data=$request->all();
        $check=$this->create($data);

        return redirect("dashboard")->withSuccess('You Have Signed-In...');

    } 
    public function create(array $data){
        return User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password'])
        ]);
    }
    public function dashboard(){
        $uid=Auth::user()->id;
        $data=Task::where('user_id',$uid)->get();
        // print_r($data); exit;
        return view('dashboard',compact('data'));
       
        // return view('dashboard');
    }
    public function addtask(){        
        return view('addtask');
    }
    public function logout(){
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
