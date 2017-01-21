<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'id' => '1',
                'name' => 'list-users',
                'display_name' => 'List users',
                'description' => 'List all users',
            ],

            [
                'id' => '2',
                'name' => 'show-user',
                'display_name' => 'show user',
                'description' => 'Show user profile',
            ],

            [
                'id' => '3',
                'name' => 'edit-user-contact',
                'display_name' => 'edit user contact',
                'description' => 'edit user contact',
            ],

            [
                'id' => '4',
                'name' => 'update-user-contact',
                'display_name' => 'update user contact',
                'description' => 'update user contact',
            ],

            [
                'id' => '5',
                'name' => 'update-contact-groups',
                'display_name' => 'update user contact groups',
                'description' => 'update user contact groups',
            ],

            [
                'id' => '6',
                'name' => 'delete-user-contact',
                'display_name' => 'delete user contact',
                'description' => 'delete user contact',
            ],

            [
                'id' => '7',
                'name' => 'update-user-group',
                'display_name' => 'update user group',
                'description' => 'update user group',
            ],

            [
                'id' => '8',
                'name' => 'delete-user-group',
                'display_name' => 'delete user group',
                'description' => 'delete user group',
            ],

            [
                'id' => '9',
                'name' => 'update-user-roles',
                'display_name' => 'update user roles',
                'description' => 'update user roles',
            ],

            [
                'id' => '10',
                'name' => 'list-roles',
                'display_name' => 'list all roles',
                'description' => 'list all roles',
            ],

            [
                'id' => '11',
                'name' => 'store-role',
                'display_name' => 'store new role',
                'description' => 'store new role',
            ],

            [
                'id' => '12',
                'name' => 'update-role',
                'display_name' => 'update role',
                'description' => 'update role',
            ],

            [
                'id' => '13',
                'name' => 'update-role-perms',
                'display_name' => 'update role permissions',
                'description' => 'update role permissions',
            ],

            [
                'id' => '14',
                'name' => 'delete-role',
                'display_name' => 'delete role',
                'description' => 'delete role',
            ],
        ]);
        DB::table('users')->insert([
            'id' => '1',
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'mobile' => '1234567890',
            'code' => '+970',
            'password' => bcrypt('admin'),
        ]);

        DB::table('roles')->insert([
            'id' => '1',
            'name' => 'admin',
            'display_name' => 'admin',
            'description' => 'admin',
        ]);

        DB::table('role_user')->insert([
            'user_id' => '1',
            'role_id' => '1',
        ]);

        DB::table('permission_role')->insert([
            [
                'permission_id' => '1',
                'role_id' => '1',
            ],

            [
                'permission_id' => '2',
                'role_id' => '1',
            ],

            [
                'permission_id' => '3',
                'role_id' => '1',
            ],

            [
                'permission_id' => '4',
                'role_id' => '1',
            ],

            [
                'permission_id' => '5',
                'role_id' => '1',
            ],

            [
                'permission_id' => '6',
                'role_id' => '1',
            ],

            [
                'permission_id' => '7',
                'role_id' => '1',
            ],

            [
                'permission_id' => '8',
                'role_id' => '1',
            ],

            [
                'permission_id' => '9',
                'role_id' => '1',
            ],

            [
                'permission_id' => '10',
                'role_id' => '1',
            ],

            [
                'permission_id' => '11',
                'role_id' => '1',
            ],

            [
                'permission_id' => '12',
                'role_id' => '1',
            ],

            [
                'permission_id' => '13',
                'role_id' => '1',
            ],

            [
                'permission_id' => '14',
                'role_id' => '1',
            ],

        ]);


    }
}
