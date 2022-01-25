<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Http\Models\Role;

class AdminManagementController extends Controller
{

    public function index()
    {
        $role = Role::all();
        $users = User::all();
        // foreach ($users as $user){
            
        // dd($user->logs()->get());
        // }
        $userRoles  = \DB::table('users_roles')->whereUserId(Auth::user()->id)->get()->pluck('role_id')->toArray();
        
        return view('admin-management.index', compact('users','role','userRoles'));
    }

    public function addUser(Request $request)
    {
        $create = $user = User::create([
            'name'      => $request->name,
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => bcrypt('bikin.co')
        ]);

        $user->roles()->attach($request->role);

        if($create){
            toast('Pembuatan Akun Berhasil','success')->position('center')->timerProgressBar()->width('400px');
        };

        return redirect()->back();
    }

    public function resetPassword(Request $request)
    {
        $user = User::find($request->id);

        $update = $user->update([
            'password' => bcrypt('sayaadminbikinco'),
        ]);

        if($update){
            toast('Kata Sandi Berhasil di Reset default menjadi sayaadminbikinco','success')->position('center')->timerProgressBar()->width('400px');
        };
        
        return redirect()->back();
    }
}
