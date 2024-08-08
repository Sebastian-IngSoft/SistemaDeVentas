<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    
    public function index(){
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    public function store(Request $request){
        Customer::create($request->all());
        return redirect()->route('customer.index');
    }

    public function update(Request $request, Customer $customer){
        $customer->update($request->all());
        return redirect()->route('customer.index');
    }
}
