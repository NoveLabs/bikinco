<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Jenssegers\Agent\Agent;
use Session;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Alert;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    
    public function __construct(){
        $this->agent = new Agent();
      }
    
    public function update(Request $request, $id)
    { 
        
        $validator = Validator::make($request->all(),[
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);
        
        if ($validator->fails()) {
            $message_errors = "";
                foreach ($validator->errors()->all() as $message) {
                    $message_errors .= $message;
                }
                toast($message,'error','success')->position('center')->timerProgressBar()->width('400px');

            return redirect()->back();
        }
    
        $hashedPassword = Auth::user()->password;
    
        if (\Hash::check($request->oldpassword , $hashedPassword )) {
    
            if (!\Hash::check($request->password , $hashedPassword)) {
    
                $users =User::find(Auth::user()->id);
                $users->password = bcrypt($request->password);
                User::where( 'id' , Auth::user()->id)->update( array( 'password' =>  $users->password));
                   
                toast('password updated successfully','success')->position('center')->timerProgressBar()->width('400px');
                
                saveActivityUser($request, $this->agent, 'Memperbarui kata sandi');
                return redirect()->back();
                
            }
            else{
                    toast('new password can not be the old password!','error')->position('center')->timerProgressBar()->width('400px');
                    return redirect()->back();
                }
        } else{
                toast('old password doesnt matched','error')->position('center')->timerProgressBar()->width('400px');
                return redirect()->back();
            }
    
     }

    
}
