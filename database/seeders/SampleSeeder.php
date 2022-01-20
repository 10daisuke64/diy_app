<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // DB::table('users')->insert([
        //     'name' => '澄田大輔',
        //     'email' => 'd.i.suke.226@gmail.com',
        //     'password' => 'password',
        // ]);

        $init_users = [
            [
                'name' => '澄田大輔',
                'email' => 'd.i.suke.226@gmail.com',
                'password' => 'password',
            ],

            // ここに追加できます
        ];

        foreach($init_users as $init_user) {

            $user = new User();
            $user->name = $init_user['name'];
            $user->email = $init_user['email'];
            $user->password = Hash::make($init_user['password']);
            $user->save();

        }
    }
}
