<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function changeManualPassword(Request $request) {

        $request->validate([
            'password' => 'required|string',
        ]);
    
        User::where('id', $request->user_id)->update([
            'password'=>Hash::make($request->password)
        ]);
       
        return back()->with('msg', 'Contraseña actualizada correctamente');
    }

    public function changeAutomaticPassword(Request $request) {

        $randomPassword = Str::random(12); 

        User::where('id', $request->user_id)->update([
            'password'=>Hash::make($randomPassword)
        ]);
        return back()->with('msg', 'Contraseña actualizada correctamente');
    }
}
