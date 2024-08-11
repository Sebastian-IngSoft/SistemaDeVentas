<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'ticket_id', 'product_id'];

    //creando las ventas relacionadas con el ticket 1x1
    public function salesStore(Request $request ,$ticket_id)
    {
        $sale = new Sale;
        for ($i = 0; $i < count($request->products); $i++) {
            $sale->create([
                'amount' => $request->quantities[$i],
                'ticket_id' => $ticket_id,
                'product_id' => $request->products[$i]

            ]);
        }
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
