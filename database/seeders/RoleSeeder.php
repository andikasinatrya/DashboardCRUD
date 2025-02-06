<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permissions
        $permissions = [
            'view-persones', 'view-hobbies', 'view-javascript-persones', 'view-blog', 'view-users', 'view-roles',

            'view roles', 'create roles', 'edit roles', 'delete roles', 'show roles',

            'view users', 'create users', 'edit users', 'delete users', 'assign roles',

            'view hobbies', 'create hobbies', 'edit hobbies', 'delete hobbies', 'manage hobbies',

            'view persons', 'create persons', 'edit persons', 'delete persons', 'manage persons',

            'view telephones', 'create telephones', 'edit telephones', 'delete telephones', 'manage telephones',

            'view blog', 'create blog', 'edit blog', 'delete blog',

            'view dashboard',

            'view javascript', 'create javascript', 'edit javascript', 'delete javascript',

            'view javascriptpersones', 'create javascriptpersones', 'edit javascriptpersones', 'delete javascriptpersones',

            'upload blog images'
        ];
    
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    
        // Roles
        $koordinator = Role::firstOrCreate(['name' => 'koordinator']);
        $koordinator->givePermissionTo(Permission::all());
    
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo([
            'view roles',
            'view users',
            'view hobbies',
            'view persons',
            'view telephones',
            'view blog',
            'view dashboard',
            'view javascript',
            'view javascriptpersones',
            'view-persones', 
            'view-hobbies', 
            'view-javascript-persones', 
            'view-blog', 'view-users', 
            'view-roles',
        ]);
        
    
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $userRole->givePermissionTo([
            'view blog', 
            'view dashboard',
            'create blog', 
            'edit blog', 
            'delete blog', 
            'upload blog images',
            'view-blog',
        ]);
    
        // Assign roles to users
        $koordinatorUser = User::factory()->create([
            'name'     => 'Koordinator User',
            'email'    => 'koordinator@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $koordinatorUser->assignRole($koordinator);
    
        $adminUser = User::factory()->create([
            'name'     => 'Admin User',
            'email'    => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $adminUser->assignRole($admin);
    
        $regularUser = User::factory()->create([
            'name'     => 'Regular User',
            'email'    => 'user@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $regularUser->assignRole($userRole);
    }
}
