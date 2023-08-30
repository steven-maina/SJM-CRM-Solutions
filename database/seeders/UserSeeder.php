<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $code=Str::random(20);
        $business_code=Str::random(20);
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@themesbrand.com',
            'phone_number'=> '0708737839',
            'user_code'=>$code,
            'account_code'=>$business_code,
//            'role_id'=>2,
            'status'=>'Active',
            'password' => Hash::make(12345678),
            'created_at' => now(),
            'created_by' => 1,
        ]);
        $role = Role::create(['name' => 'admin']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
        $code=Str::random(10);
        $user = User::create([
            'name' => 'stephen',
            'email' => 'stevenmaina17@gmail.com',
            'phone_number'=> '0710767015',
            'user_code'=>$code,
            'account_code'=>$business_code,
//            'role_id'=>1,
            'status'=>'Active',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'created_by' => 2,
        ]);
        $role = Role::create(['name' => 'superuser']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}
