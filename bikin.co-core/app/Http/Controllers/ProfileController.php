<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Agent\Agent;
use App\User;
use App\Http\Models\Role;
use Auth;
use App\Http\Models\Userlog;

class ProfileController extends Controller
{
    public function __construct(){
        $this->agent = new Agent();
    }

    public function index()
    {
        $role = Role::all()->except(1);
        $userRoles  = \DB::table('users_roles')->whereUserId(Auth::user()->id)->get()->pluck('role_id')->toArray();
        foreach (Auth::user()->roles as $listrole){
            if ($listrole->id == 1){
                $role = Role::all();
            };
        }
        return view('user.editprofile',compact('role', 'userRoles'));
    }

    public function post(Request $request, $id)
    {
        $user = User::find($id);
        $user->update([
            'name'  => $request->name,
            'username'  => $request->username
        ]);
        
        $user->roles()->detach();
        $user->roles()->attach($request->role);

        toast('informasi profile berhasil di perbarui','success')->position('center')->timerProgressBar()->width('400px');
        saveActivityUser($request, $this->agent, 'Memperbarui informasi profile');
        return redirect()->back();
    }

    public function profile()
    {
        $user =  User::where('id', Auth::user()->id)->first();
        $data = Auth::user()->roles()->get()->pluck('name')->toArray();
        $logs  = Userlog::where('user_id', Auth::user()->id)->orderBy('id','DESC')->get();
        return view('user.profile', compact('data', 'user','logs'));
    }

    public function updatePhoto(Request $request, $id)
    {
        $user = User::find($id);
        $image = $request->file('file');
        $namaGambar = Auth::user()->name.time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/user');
        $image->move($destinationPath, $namaGambar);
        if(!empty($request->file('file'))){
            $user->update([
                'images' => $namaGambar
            ]);
        }
        saveActivityUser($request, $this->agent, 'Memperbarui foto profile');
    }

    public function updateEmail(Request $request, $id)
    {
     
        $validator = Validator::make($request->all(),[
            'password' => 'required|confirmed',
            'email' => 'required|email',
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

        if (\Hash::check($request->password , $hashedPassword )) {

            User::where( 'id' , Auth::user()->id)->update( array( 'email' =>  $request->email));
            toast('email updated successfully','success')->position('center')->timerProgressBar()->width('400px');
            
            saveActivityUser($request, $this->agent, 'Memperbarui alamat email');
            return redirect()->back();

        }else{
            toast('password doesnt matched','error')->position('center')->timerProgressBar()->width('400px');
            return redirect()->back();
        }

    }

    
}
