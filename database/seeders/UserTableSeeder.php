<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Oswaldo Ortega";
        $user->email = "oortega_17@alu.uabcs.mx";
        $user->password = bcrypt("abcd1234");
        $user->save();
    }
}
