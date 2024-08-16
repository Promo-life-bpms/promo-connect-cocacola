<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MuestraController extends Controller
{
    public function especialCambiarFecha(Request $request) {

        $request->validate([
            'id' => 'required',
            'date' => 'required',
        ]);

        DB::table('muestras')->where('id',$request->id)->update([
            'estimated_delivery' => $request->date 
        ]);
        return redirect()->back()->with('message', 'actualizado correctamente');

    }
}
