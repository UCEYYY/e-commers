<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'manage-Kategori',
            'manage-produk',
            'manage-pelanggan',
            'manage-pesanan',
            'manage-users',
        ];
        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::firstOrCreate(['name' => $permission]);
        }
        $adminRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin']);
        $adminRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'gudang']);
        $adminRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'pelanggan']);

        $adminRole->givePermissionTo($permissions)([
            'manage-Kategori',
            'manage-produk',
            'manage-pelanggan',
            'manage-pesanan',
            'manage-users',
        ]);
        $gudangRole->givePermissionTo([
            'manage-Kategori',
            'manage-produk',
            'manage-pesanan',
        ]);
        $pelangganRole->givePermissionTo([
            'manage-pesanan',
        ]);
        $admin = User::firstOrCreate([
            'name' => 'Admin',
            'email' => 'admin@toko.com',
        ], [
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('$adminRole');
        $gudang = User::firstOrCreate([
            'name' => 'Gudang',
            'email' => 'gudang@toko.com',
        ], [
            'password' => bcrypt('password'),
        ]);
        $gudang->assignRole('$gudangRole');
        $pelanggan = User::firstOrCreate([
            'name' => 'Pelanggan',
            'email' => 'pelanggan.toko.com',
        ], [
            'password' => bcrypt('password'),
        ]);
        $pelanggan->assignRole('$pelangganRole');
    }
}
