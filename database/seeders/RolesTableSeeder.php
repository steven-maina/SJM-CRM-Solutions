<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
      public function run()
    {
      $roles = [
//        [
//          'id'    => 1,
//          'title' => 'Admin',
//        ],
//        [
//          'id'    => 4,
//          'title' => 'Super',
//        ],
        [
          'id'    => 2,
          'title' => 'Agent',
        ],
        [
          'id'    => 3,
          'title' => 'Customer',
        ],
      ];

      Role::insert($roles);
    }

}
