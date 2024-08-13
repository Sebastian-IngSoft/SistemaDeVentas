<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
   
    public function index(){
        $wallets= Wallet::orderby('id','desc')->get();
        return view('wallets.index',compact('wallets'));
    }
}
