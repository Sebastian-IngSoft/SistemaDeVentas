<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//IMPORTANDO EL MODELO ROLE DE SPATIE
Use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Creando roles
        $adminRole = Role::create([
            'name' => 'admin'
        ]);

        $sellerRole = Role::create([
            'name' => 'seller'
        ]);

        //creando permisos
        Permission::create((['name'=>'dashboard']))->syncRoles([$adminRole,$sellerRole]);

        //permisos para productos products
        Permission::create((['name'=>'products.index']))->syncRoles([$adminRole,$sellerRole]);
        Permission::create((['name'=>'products.store']))->syncRoles([$adminRole,$sellerRole]);
        Permission::create((['name'=>'products.update']))->syncRoles([$adminRole]);
        Permission::create((['name'=>'products.visibility']))->syncRoles([$adminRole]);

        //permisos para clientes customers
        Permission::create((['name'=>'customer.index']))->syncRoles([$adminRole,$sellerRole]);
        Permission::create((['name'=>'customer.store']))->syncRoles([$adminRole,$sellerRole]);
        Permission::create((['name'=>'customer.update']))->syncRoles([$adminRole,$sellerRole]);
        
        //permisos para boletas tickets
        Permission::create((['name'=>'ticket.index']))->syncRoles([$adminRole,$sellerRole]);
        Permission::create((['name'=>'ticket.store']))->syncRoles([$adminRole,$sellerRole]);
        Permission::create((['name'=>'ticket.showtickets']))->syncRoles([$adminRole,$sellerRole]);
        Permission::create((['name'=>'ticket.show']))->syncRoles([$adminRole,$sellerRole]);
        Permission::create((['name'=>'ticket.payment']))->syncRoles([$adminRole,$sellerRole]);
        Permission::create((['name'=>'ticket.annular']))->syncRoles([$adminRole]);

        //permisos para clientes customers
        Permission::create((['name'=>'wallet.index']))->syncRoles([$adminRole,$sellerRole]);
        Permission::create((['name'=>'wallet.deposit']))->syncRoles([$adminRole,$sellerRole]);
        Permission::create((['name'=>'wallet.withdraw']))->syncRoles([$adminRole]);

        //permisos para usuario
        Permission::create((['name'=>'register']))->syncRoles([$adminRole]);

        
    }
}
