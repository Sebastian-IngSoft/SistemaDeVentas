<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Debt;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Ticket;
use App\Models\User;
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

        User::factory()->create([
            'name' => 'ventas',
            'email' => 'ventas@ventas.com',
            'password' => 'ventas22'
        ]);
        //Factories creados
        User::factory(9)->create();
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
