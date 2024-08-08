<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index(){
        $customers = Customer::all();
        $products = Product::where('visibility', 1)->get();
        return view('sales.index', compact('customers','products'));
    }
}
