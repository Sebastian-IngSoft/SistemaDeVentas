<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    use HasFactory;

    protected $fillable = ['cancel','ticket_id','user_id'];
    // atributo cancel = [ 0 = en deuda , 1 = pagada, 2 = anulada]

    public function ticket(){
        return $this->belongsTo(Ticket::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
