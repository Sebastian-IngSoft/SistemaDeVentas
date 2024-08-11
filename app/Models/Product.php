<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','stock','purchase','sell','visibility'];

    public function stockReduction(Request $request){ //reduce el stock de los productos
        for ($i=0; $i < count($request->products) ; $i++) { // cuenta el largo del array producto
            $product = $this->find($request->products[$i]); // recupera el producto por el id
            $stockUpdate = $product->stock - $request->quantities[$i]; // hace la resta del producto encontrado con la cantidad ingresada
            $product->update(['stock'=>$stockUpdate]);// actualiza el nuevo producto
        }
    }
    //relaciones
    public function sales(){
        return $this->hasMany(Sale::class);
    }
}
