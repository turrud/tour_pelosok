<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list abouts']);
        Permission::create(['name' => 'view abouts']);
        Permission::create(['name' => 'create abouts']);
        Permission::create(['name' => 'update abouts']);
        Permission::create(['name' => 'delete abouts']);

        Permission::create(['name' => 'list aboutimages']);
        Permission::create(['name' => 'view aboutimages']);
        Permission::create(['name' => 'create aboutimages']);
        Permission::create(['name' => 'update aboutimages']);
        Permission::create(['name' => 'delete aboutimages']);

        Permission::create(['name' => 'list contacts']);
        Permission::create(['name' => 'view contacts']);
        Permission::create(['name' => 'create contacts']);
        Permission::create(['name' => 'update contacts']);
        Permission::create(['name' => 'delete contacts']);

        Permission::create(['name' => 'list explores']);
        Permission::create(['name' => 'view explores']);
        Permission::create(['name' => 'create explores']);
        Permission::create(['name' => 'update explores']);
        Permission::create(['name' => 'delete explores']);

        Permission::create(['name' => 'list exploreimages']);
        Permission::create(['name' => 'view exploreimages']);
        Permission::create(['name' => 'create exploreimages']);
        Permission::create(['name' => 'update exploreimages']);
        Permission::create(['name' => 'delete exploreimages']);

        Permission::create(['name' => 'list homes']);
        Permission::create(['name' => 'view homes']);
        Permission::create(['name' => 'create homes']);
        Permission::create(['name' => 'update homes']);
        Permission::create(['name' => 'delete homes']);

        Permission::create(['name' => 'list homeimages']);
        Permission::create(['name' => 'view homeimages']);
        Permission::create(['name' => 'create homeimages']);
        Permission::create(['name' => 'update homeimages']);
        Permission::create(['name' => 'delete homeimages']);

        Permission::create(['name' => 'list orders']);
        Permission::create(['name' => 'view orders']);
        Permission::create(['name' => 'create orders']);
        Permission::create(['name' => 'update orders']);
        Permission::create(['name' => 'delete orders']);

        Permission::create(['name' => 'list packages']);
        Permission::create(['name' => 'view packages']);
        Permission::create(['name' => 'create packages']);
        Permission::create(['name' => 'update packages']);
        Permission::create(['name' => 'delete packages']);

        Permission::create(['name' => 'list packageimages']);
        Permission::create(['name' => 'view packageimages']);
        Permission::create(['name' => 'create packageimages']);
        Permission::create(['name' => 'update packageimages']);
        Permission::create(['name' => 'delete packageimages']);

        Permission::create(['name' => 'list allpeople']);
        Permission::create(['name' => 'view allpeople']);
        Permission::create(['name' => 'create allpeople']);
        Permission::create(['name' => 'update allpeople']);
        Permission::create(['name' => 'delete allpeople']);

        Permission::create(['name' => 'list tagabouts']);
        Permission::create(['name' => 'view tagabouts']);
        Permission::create(['name' => 'create tagabouts']);
        Permission::create(['name' => 'update tagabouts']);
        Permission::create(['name' => 'delete tagabouts']);

        Permission::create(['name' => 'list tagexplores']);
        Permission::create(['name' => 'view tagexplores']);
        Permission::create(['name' => 'create tagexplores']);
        Permission::create(['name' => 'update tagexplores']);
        Permission::create(['name' => 'delete tagexplores']);

        Permission::create(['name' => 'list taghomes']);
        Permission::create(['name' => 'view taghomes']);
        Permission::create(['name' => 'create taghomes']);
        Permission::create(['name' => 'update taghomes']);
        Permission::create(['name' => 'delete taghomes']);

        Permission::create(['name' => 'list tagpackages']);
        Permission::create(['name' => 'view tagpackages']);
        Permission::create(['name' => 'create tagpackages']);
        Permission::create(['name' => 'update tagpackages']);
        Permission::create(['name' => 'delete tagpackages']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
