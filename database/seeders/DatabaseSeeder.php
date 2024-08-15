<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Debt;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Wallet;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 
        
        //creando roles
        $this->call(RoleSeeder::class);

        User::create([
            'name' => 'ventas',
            'email' => 'ventas@ventas.com',
            'password' => 'ventas22'
        ])->assignRole('admin');
        
        Wallet::create([
            'balance' => 0,
            'flow' => 0,
            'walletable_type' => 'App\Models\User',
            'walletable_id' => 1
        ]);
        
        //Factories
        User::factory(9)->create()->each(function ($user) {
            $user->assignRole('seller');
        });
        
        
        Product::factory(50)->create();
        Customer::factory(20)->create();
        Ticket::factory(50)->create();
        Sale::factory(50)->create();

        //relacionar los tickets con deudas 
        $tickets = Ticket::all();
        foreach ($tickets as $ticket) {
            Debt::factory()->create([
                'ticket_id' => $ticket->id,
            ]);
        }
        
    }
}
