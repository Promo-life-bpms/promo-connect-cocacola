<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class InvitedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'invited',
            'display_name' => 'Invitado', 
            'description' => 'Usuario invitado, no puede ver los precios' , 
        ]);



    }
}
