<?php

namespace App\Http\Controllers;

use App\Models\Catalogo\Product;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class ExportDataController extends Controller
{
    public function exportUser(Request $request){

        $data = Excel::toArray(null, $request->file('excel'));

        // Obtener los datos de la columna A a partir de la fila 4 hacia abajo
        $user_names = collect($data[0])->splice(1)->pluck(1);
        $user_mails = collect($data[0])->splice(1)->pluck(2);
        $user_roles = collect($data[0])->splice(1)->pluck(3);

        foreach ($user_names as $index => $user_name) {

            $email = str_replace(['<', '>',','], '', $user_mails[$index]);
            $mail_existe = User::where('email', trim($email))->first();

            if(!$mail_existe){
                $random_password = Str::random(10);
                $hashed_password = bcrypt($random_password);
    
                $create_user = new User();
                $create_user->name = $user_names[$index];
                $create_user->email = trim($email);
                $create_user->password = $hashed_password;
                $create_user->save();
                
                //3 admin compras -  4 comprador normal
                $create_role_user = new RoleUser();
                $create_role_user->user_id = $create_user->id;
                $create_role_user->role_id = $user_roles[0] == 'Administrador'? 3: 4; 
                $create_role_user->user_type = 'App\Models\User';
                $create_role_user->save();
            }
        }

        return back()->with('mensaje', 'Usuarios guardados correctamente');
    }

    public function presentation()  {
        
        return view('presentation');
    }


    public function importation() {
        /* $only_products =[
            3174,389293,389309,389311,389312,389313,389644,458583,456208,456467,456470,456476,
            456480,456482,456232,456493,456494,456750,456751,456752,456245,456508,456509,456767,456522,456545,
            456547,456548,456293,456549,456558,456304,456568,456575,456577,456329,456330,456344,456345,456346,
            456602,456347,456348,456349,456369,456642,456643,456644,456645,456646,456647,456648,456649,456398,
            456399,456410,456678,456679,456680,456681,456426,456683,456428,456684,456429,456685,456430,456686
        ];

        $products = Product::whereIn('id',$only_products)->get();
        
        return view('importation', compact('products')); */

        return view('livewire.productos-importacion');

    }
}


