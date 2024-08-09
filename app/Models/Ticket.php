<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use LengthException;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'customer_id' , 'price'];

    //creando las ventas relacionadas con el ticket
    public function salesStore(Request $request){
        $sale = new Sale;
        for ($i=0; $i < count($request->products)  ; $i++) { 
            $sale->create([
                'amount'=> $request->quantities[$i],
                'ticket_id'=> $this->id,
                'product_id'=> $request->products[$i]
                
            ]);
        }
    }
    //relaciones
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
