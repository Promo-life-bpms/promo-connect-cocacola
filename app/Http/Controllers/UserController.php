<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function miCuenta() {
                    
        $user = auth()->user();
        return view('pages.user.profile',compact('user'));
    }

    public function actualizarLocalidad(Request $request) {
        
        $user =  auth()->user();

        DB::table('users')->where('id', $user->id)->update([
            'current_location' => $request->location
        ]);

        
        return redirect()->back()->with('locate', 'localidad cambiada correctamente');

    }
}
