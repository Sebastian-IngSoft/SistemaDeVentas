<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    
    protected $fillable = ['amount', 'ticket_id', 'product_id' ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function ticket(){
        return $this->belongsTo(Ticket::class);
    }
}
