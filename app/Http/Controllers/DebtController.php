<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use App\Models\Ticket;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    public function store(Ticket $ticket){//relaciona el ticket (boleta) con debt (deuda)
        Debt::create([
            'ticket_id' => $ticket->id
        ]);
    }

    public function payment(){
        
    }
}
