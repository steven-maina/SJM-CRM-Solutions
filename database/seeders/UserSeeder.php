<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\User;
use App\Models\UserCode;
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
      $role = Role::create(['name' => 'admin']);
      $account=Account::create(['name' =>'testing'], ['created_by'=>1]);
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'phone_number'=> '0708737839',
//            'user_code'=>$code,
            'account_id'=>$account->id,
            'role_id'=>$role->id,
            'status'=>'Active',
            'password' => Hash::make(12345678),
            'created_at' => now(),
            'created_by' => 1,
        ]);
        $permissions = Permission::pluck('id')->all();
        $role->syncPermissions($permissions);
      UserCode::create(['user_id'=>$user->id, 'code' =>rand(100000, 999999)]);

//        $user->assignRole([$role->id]);


      $role = Role::create(['name' => 'super user']);

        $user = User::create([
            'name' => 'stephen',
            'email' => 'stevenmaina17@gmail.com',
            'phone_number'=> '0710767015',
//            'user_code'=>$code,
            'account_id'=>$account->id,
            'role_id'=>$role->id,
            'status'=>'Active',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'created_by' => 2,
        ]);
        $role = Role::create(['name' => 'superuser']);
       UserCode::create(['user_id'=>$user->id,'code' =>rand(100000, 999999)]);
        $permissions = Permission::pluck('id')->all();
        $role->syncPermissions($permissions);
//        $user->assignRole([$role->id]);
    }
}
