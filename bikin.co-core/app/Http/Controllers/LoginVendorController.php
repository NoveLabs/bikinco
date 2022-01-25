<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Jenssegers\Agent\Agent;
use App\Http\Models\Vendor;
use Session;
use Validator;
use Alert;

class LoginVendorController extends Controller
{

    protected $agent;
    protected $vendor;

    public function __construct() 
    {
        $this->agent = new Agent();

        $this->vendor = new Vendor();
    }

    public function index()
    {
        return view('auth.vendor.login');
    }  
    public function register()
    {
        return view('register');
    }
    
    public function login(Request $request)
    {
        request()->validate([
          'email' => 'required',
          'password' => 'required',
        ]);

        $loginType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
           if (Auth::guard('vendor')->attempt($credentials)) {
            //Authentication passed...
            saveActivityVendor($request, $this->agent, 'Login');

            return redirect('vendor');
        }

        toast('Invalid credentials','error')->position('top')->timerProgressBar()->width('400px');

        return redirect('vendor/login');

    }
    
    public function dashboard()
    {
        if(Auth::check()) {
            return view('vendor/login');
        }
      // return redirect()->route('login.vendor')->withSuccess('Oppes! You have entered invalid credentials');
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }
    
    public function logout(Request $request) 
    {
        saveActivityVendor($request, $this->agent, 'Logout');

        Session::flush();

        Auth::guard('vendor')->logout();
        
        return Redirect('vendor/login');
    }

}
