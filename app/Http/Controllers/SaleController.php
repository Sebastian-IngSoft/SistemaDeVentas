<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index(){
        $customers = Customer::all();
        $products = Product::where('visibility', 1)->get();
        return view('sales.index', compact('customers','products'));
    }

    public function salesStore(Request $request ,$ticket_id){
        $sale = new Sale;
        $sale->salesStore($request, $ticket_id); // pasa el request y el ticket_id para poder relacionarlo
    }
}
