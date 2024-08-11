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
