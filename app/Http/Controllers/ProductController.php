<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::where('visibility','1')->orderby('name','asc')->get();
        return view('products.index', compact('products'));
    }

    public function store(Request $request){
        Product::create($request->all());

        return redirect()->route('product.index');
    }

    public function update(Request $request, Product $product){
        $product->update($request->all());
        return redirect()->route('product.index');
    }

    public function visibility (Product $product){
        $product->visibility = 0 ;
        $product->save();
        return redirect()->route('product.index');
        
    }

    public function stockReduction (Request $request){//hace la reduccion de los productos actualizandolo se creo en el modelo 
        $product = new Product;
        $product->stockReduction($request);
    }
}
