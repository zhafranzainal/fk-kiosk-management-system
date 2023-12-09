<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Define permissions for manage users
        $manageUserPermissions = [
            'list users',
            'view users',
            'create users',
            'update users',
            'delete users',
        ];

        // Define permissions for manage kiosks
        $manageKioskPermissions = [
            'list kiosks',
            'view kiosks',
            'create kiosks',
            'update kiosks',
            'delete kiosks',
        ];

        // Define permissions for manage applications
        $manageApplicationPermissions = [
            'list applications',
            'view applications',
            'create applications',
            'update applications',
            'delete applications',
        ];

        // Define permissions for manage sales
        $manageSalePermissions = [
            'list sales',
            'view sales',
            'create sales',
            'update sales',
            'delete sales',
        ];

        // Define permissions for manage payments
        $manageTransactionPermissions = [
            'list transactions',
            'view transactions',
            'create transactions',
            'update transactions',
            'delete transactions',
        ];

        // Define permissions for manage complaints
        $manageComplaintPermissions = [
            'list complaints',
            'view complaints',
            'create complaints',
            'update complaints',
            'delete complaints',
        ];

        $permissionArrays = [
            $manageUserPermissions,
            $manageKioskPermissions,
            $manageApplicationPermissions,
            $manageSalePermissions,
            $manageTransactionPermissions,
            $manageComplaintPermissions,
        ];

        // Create all permissions
        foreach ($permissionArrays as $permissions) {
            foreach ($permissions as $permission) {
                Permission::create(['name' => $permission]);
            }
        }

        // Create super admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }

        // Define roles with respective permissions
        $rolesAndPermissions = [
            'admin' => array_merge(
                $manageUserPermissions,
                $manageKioskPermissions,
                $manageApplicationPermissions,
                $manageSalePermissions
            ),
            'pupuk-admin' => array_merge(
                $manageApplicationPermissions,
                $manageTransactionPermissions,
                $manageComplaintPermissions
            ),
            'kiosk-participant' => array_merge(
                $manageApplicationPermissions,
                $manageSalePermissions,
                $manageTransactionPermissions,
                $manageComplaintPermissions
            ),
            'technical-team' => $manageComplaintPermissions,
            'fk-bursary' => $manageTransactionPermissions,
        ];

        // Create roles and assign permissions
        foreach ($rolesAndPermissions as $roleName => $permissions) {
            $flatPermissions = is_array($permissions) ? Arr::flatten($permissions) : [$permissions];
            $role = Role::create(['name' => $roleName]);
            $role->givePermissionTo(Permission::whereIn('name', $flatPermissions)->get());
        }

        $user = User::whereEmail('admin@example.com')->first();
        if ($user) {
            $user->assignRole('admin');
        }

        $user = User::whereEmail('pupuk@example.com')->first();
        if ($user) {
            $user->assignRole('pupuk-admin');
        }

        $user = User::whereEmail('participant@example.com')->first();
        if ($user) {
            $user->assignRole('kiosk-participant');
        }

        $user = User::whereEmail('technical@example.com')->first();
        if ($user) {
            $user->assignRole('technical-team');
        }

        $user = User::whereEmail('bursary@example.com')->first();
        if ($user) {
            $user->assignRole('fk-bursary');
        }
    }
}
