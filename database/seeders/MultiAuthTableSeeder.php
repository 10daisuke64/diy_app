<?php

namespace Database\Seeders;

use App\Models\Diyer_user;
use App\Models\Mentor_user;
use App\Models\Diyer_profile;
use App\Models\Mentor_profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MultiAuthTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DIYer
        $init_diyers = [
            [
                'user_name' => 'diyer_sample',
                'name' => 'diyerサンプル',
                'email' => 'diyer@example.com',
                'password' => 'password',
                'profile_id' => 1,
            ],

            // ここに追加できます
        ];

        foreach($init_diyers as $init_diyer) {

            $diyer_profile = new Diyer_profile();
            $diyer_profile->id = $init_diyer['profile_id'];
            $diyer_profile->save();

            $diyer = new Diyer_user();
            $diyer->user_name = $init_diyer['user_name'];
            $diyer->name = $init_diyer['name'];
            $diyer->email = $init_diyer['email'];
            $diyer->password = Hash::make($init_diyer['password']);
            $diyer->profile_id = $init_diyer['profile_id'];
            $diyer->save();
        }

        // Mentor
        $init_mentors = [
            [
                'user_name' => 'mentor_sample',
                'name' => 'mentorサンプル',
                'email' => 'mentor@example.com',
                'password' => 'password',
                'profile_id' => 1,
            ],

            // ここに追加できます
        ];

        foreach($init_mentors as $init_mentor) {

            $mentor_profile = new Mentor_profile();
            $mentor_profile->id = $init_mentor['profile_id'];
            $mentor_profile->save();

            $mentor = new Mentor_user();
            $mentor->user_name = $init_mentor['user_name'];
            $mentor->name = $init_mentor['name'];
            $mentor->email = $init_mentor['email'];
            $mentor->password = Hash::make($init_mentor['password']);
            $mentor->profile_id = $init_mentor['profile_id'];
            $mentor->save();

        }

    }
}
