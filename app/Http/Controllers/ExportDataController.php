<?php

namespace App\Http\Controllers;

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
}


