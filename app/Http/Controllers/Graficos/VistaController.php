<?php
namespace App\Http\Controllers\Graficos;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VistaController extends Controller
{
    public function index(){
        // Fechas del mes actual
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Consulta para obtener los productos más comprados en el mes actual
        $boardSale = Sale::select('product_id', Sale::raw('SUM(amount) as total_amount'))
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->groupBy('product_id')
            ->orderBy('total_amount', 'desc')
            ->get();

        // Calcular la ganancia bruta y neta
        $totalGrossProfit = 0;
        $totalNetProfit = 0;

        foreach ($boardSale as $sale) {
            $product = Product::find($sale->product_id);
            $grossProfit = $sale->total_amount * $product->sell;
            $netProfit = $grossProfit - ($sale->total_amount * $product->purchase);

            $totalGrossProfit += $grossProfit;
            $totalNetProfit += $netProfit;
        }

        return view('dashboard', compact('boardSale', 'totalGrossProfit', 'totalNetProfit'));
    }
}


