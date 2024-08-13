<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{

    public function index()
    {
        $wallets = Wallet::orderby('id', 'desc')->paginate(20);
        return view('wallets.index', compact('wallets'));
    }
    public function deposit(Request $request)
    {
        $latestWallet = Wallet::latest()->first();

        Wallet::create([
            'balance' => $latestWallet->balance + $request->deposit,
            'flow' => $request->deposit,
            'walletable_type' => 'App\Models\User',
            'walletable_id' => Auth::id()

        ]);
        return redirect()->route('wallet.index');
    }
    public function withdraw(Request $request)
    {

        $latestWallet = Wallet::latest()->first();

        Wallet::create([
            'balance' => $latestWallet->balance - $request->withdraw,
            'flow' => -$request->withdraw,
            'walletable_type' => 'App\Models\User',
            'walletable_id' => Auth::id()
        ]);

        return redirect()->route('wallet.index');
    }
}
