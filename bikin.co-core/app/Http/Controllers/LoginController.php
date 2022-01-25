<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Jenssegers\Agent\Agent;
use Session;
use Validator;
use Alert;


class LoginController extends Controller
{

    protected $agent;
    public function __construct(){
      $this->agent = new Agent();
    }
    public function index()
    {
        return view('auth.login');
    }  
    public function register()
    {
        return view('register');
    }
    
    public function Login(Request $request)
    {
        request()->validate([
          'email' => 'required',
          'password' => 'required',
        ]);

        $loginType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginType => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($credentials)) {
          // Authentication passed...
            saveActivityUser($request, $this->agent, 'Login');
            return redirect()->intended('home');
        }
        toast('Invalid credentials','error')->position('top')->timerProgressBar()->width('400px');

        return redirect('login');

    }
    
    public function dashboard()
    {
      if(Auth::check()){
        return view('vendor.index');
      }
      return redirect()->route('login')->withSuccess('Oppes! You have entered invalid credentials');
    }

    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    
    public function logout(Request $request) {
        saveActivityUser($request, $this->agent, 'Logout');
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }

}
