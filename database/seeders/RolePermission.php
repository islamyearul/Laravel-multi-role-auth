<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create role 

        $roleSuperAdmin = Role::create([
            'name' => 'super-admin',

        ]);

        $roleAdmin = Role::create([
            'name' => 'admin',
        ]);

        $roleUser = Role::create([
            'name' => 'user',
        ]);

        $roleEditor = Role::create([
            'name' => 'editor',
        ]);


          
        //permission list as arry
        
        $permissions = [
            [
                'group-name' => 'user',
                'permissions' => [
                    'user-list',
                    'user-create',
                    'user-edit',
                    'user-delete',
                ],               

            ],
            [
                'group-name' => 'admin',
                'permissions' => [
                    'admin.list',
                    'admin.create',
                    'admin.edit',
                    'admin.delete',
                ],               

            ],
            [
                'group-name' => 'post',
                'permissions' => [
                    'post-list',
                    'post-create',
                    'post-edit',
                    'post-delete',

                 ],
                ],
            [
                'group-name' => 'blog',
                'permissions' => [
                    'blog-list',
                    'blog-create',
                    'blog-edit',
                    'blog-delete',               
                ],               

            ],
            [
                'group-name' => 'page',
                'permissions' => [
                    'page-list',
                    'page-create',
                    'page-edit',
                    'page-delete',
                    'page-show',
                ],               

            ],
            [
                'group-name' => 'category',
                'permissions' => [
                    'category-list',
                    'category-create',
                    'category-edit',
                    'category-delete',
                    'category-show',

                ],               

            ],
            [
                'group-name' => 'tag',
                'permissions' => [
                    'tag-list',
                    'tag-create',
                    'tag-edit',
                    'tag-delete',
                    'tag-show',
                
                ],
            ],
        ];

        //asign permission to role
       for($i=0; $i < count($permissions); $i++){
            $groupName = $permissions[$i]['group-name'];
            
            
            for($y=0; $y < count($permissions[$i]['permissions']); $y++){

                $permission = Permission::create([ 'name' => $permissions[$i]['permissions'][$y],'group_name' => $groupName ]);
                $roleSuperAdmin->givePermissionTo($permission);
                $permission -> assignRole($roleSuperAdmin);

            }

           

        }
        
    }
}
