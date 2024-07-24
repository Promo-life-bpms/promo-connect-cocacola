<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use App\Notifications\changePassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function users(Request $request)
    {
        $search = $request->input('search');
        $usersQuery = User::query();
        // Aplicar filtro de búsqueda si hay término de búsqueda
        if ($search) {
            $usersQuery->where('name', 'like', '%' . $search . '%')
                       ->orWhere('email', 'like', '%' . $search . '%');
        }
        $users = $usersQuery->paginate(10);
        $roles = Role::all();
        $rolesusers = RoleUser::all();

        return view('users.usersview', compact('users', 'roles', 'rolesusers'));
    }
    
    public function changeManualPassword(Request $request) {

        $request->validate([
            'password' => 'required|string',
        ]);
    
        User::where('id', $request->user_id)->update([
            'password'=>Hash::make($request->password)
        ]);

        $Usuario = User::where('id', $request->user_id)->first();
        $email = $Usuario->email;
        $username = $Usuario->name;
        try {
            $Usuario->notify(new changePassword($username, $request->password, $email));
                
        } catch (\Exception $e) {
          
            return back()->with('msg', 'Contraseña actualizada correctamente; sin embargo, no se pudo enviar el correo');
        } 
       
        return back()->with('msg', 'Contraseña actualizada correctamente');
    }

    public function changeAutomaticPassword(Request $request) {

        $randomPassword = Str::random(12); 

        User::where('id', $request->user_id)->update([
            'password'=>Hash::make($randomPassword)
        ]);

        $Usuario = User::where('id', $request->user_id)->first();
        $email = $Usuario->email;
        $username = $Usuario->name;
        try {
            $Usuario->notify(new changePassword($username, $randomPassword, $email));
                
        } catch (\Exception $e) {
            return back()->with('msg', 'Contraseña actualizada correctamente; sin embargo, no se pudo enviar el correo');
        } 
        return back()->with('msg', 'Contraseña actualizada correctamente');
    }

    public function newUser(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
        ]);

        $randomPassword = Str::random(12); 
        $newUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password'=>Hash::make($randomPassword)

        ]);

        RoleUser::create([
            'user_id' => $newUser->id,
            "role_id" => $request->role,
            "user_type" => "App\Models\User",
        ]);

        try {
            $newUser->notify(new changePassword($request->name, $randomPassword, $request->email));   
        } catch (\Exception $e) {
            return back()->with('msg', 'Usuario creado correctamente; sin embargo, no se pudo enviar el correo');
        } 
        
        return back()->with('msg', 'Usuario creado correctamente.');
    }

    public function updateUser(Request $request)
    {
        //dd($request);
        //dd($request->id);
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        DB::table('users')->where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        $roles = DB::table('role_user')->where('user_id', $request->id)->get();
        if($roles){
            DB::table('role_user')->where('user_id', $request->id)->delete();
        }
        
        RoleUser::create([
            'user_id' => $request->id,
            'role_id' => $request->role,
            'user_type' => 'App\Models\User',
        ]);
        
        return back()->with('msg', 'Usuario editado correctamente.');
    }
}
