<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Section;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = 'password123'; // Replace with your desired password
        $hashedPassword = Hash::make($password);
        $faker = Faker::create();

        DB::table('users')->insert([
            'name' => 'Super Admin dela Cruz',
            'is_active' =>  1,        
            'email' => 'superadmin@example.com',
            'email_verified_at' => now(),
            'password' => $hashedPassword,
            'last_login' => null,
            'remember_token' => Str::random(10),
        ]);

        DB::table('users')->insert([
            'name' => 'Admin dela Cruz',
            'is_active'    =>  1,        
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'last_login'    =>  null,
            'remember_token' => Str::random(10),
        ]);

        DB::table('users')->insert([
            'name' => 'User dela Cruz',
            'is_active'    =>  1,
            'email' => 'user@example.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'last_login'    =>  null,
            'remember_token' => Str::random(10),
        ]);




        $superAdmin = User::where('email','superadmin@example.com')->first();
        $admin = User::where('email','admin@example.com')->first();
        $user = User::where('email','user@example.com')->first();
      
        $roles = Role::all();
        foreach($roles as $role){

            //Insert role of role of Default Super Admin
            $roleUser = new RoleUser();
            $roleUser->user_id = $superAdmin->id;
            $roleUser->role_id = $role->id;
            $roleUser->save();

            //Insert roles of Default Admin
            if($role->id >= 2){
                $roleUser = new RoleUser();
                $roleUser->user_id = $admin->id;
                $roleUser->role_id = $role->id;
                $roleUser->save();
            }

            //Insert roles of User
            if($role->id >= 3){
                $roleUser = new RoleUser();
                $roleUser->user_id = $user->id;
                $roleUser->role_id = $role->id;
                $roleUser->save();
            }
            
           
        }      
    }
}
