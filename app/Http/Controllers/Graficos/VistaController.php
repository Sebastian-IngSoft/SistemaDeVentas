<?php

namespace App\Http\Controllers\Graficos;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VistaController extends Controller
{
    public function index(){
        // Obtener la fecha del primer día del mes y la fecha actual
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Consulta para obtener los productos más comprados en el mes actual
        $boardSale = Sale::select('product_id', Sale::raw('SUM(amount) as total_amount'))
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->groupBy('product_id')
            ->orderBy('total_amount', 'desc')
            ->get();

        return view('dashboard', compact('boardSale'));
    }
}

