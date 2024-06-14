<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShoppingController extends Controller
{
    public function shoppingRate(Request $request) {

        DB::table('shopping_information')->where('id', $request->shopping_id)->update([
            'rank' => $request->star,
            'oportunity' => 'Completado',
        ]);
       
        return back()->with('message', '¡Evaluación completada, muchas gracias!');
    }
}
