<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MuestraController extends Controller
{
    public function editDate(Request $request) {


        return redirect()->back()->with('message', 'actualizado correctamente');

    }
}
