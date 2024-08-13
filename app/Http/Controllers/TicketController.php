<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Debt;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{

    public function index()
    {   
        // Vista para crear la venta
        $customers = Customer::orderby('name','asc')->get();
        $products = Product::where('visibility', 1)->orderby('name','asc')->get();
        return view('tickets.index', compact('customers', 'products'));
    }

    public function store(Request $request)
    {
        // Obtener el usuario autenticado
        $userId = Auth::id();
    
        // Crear un nuevo ticket con el ID del usuario
        $ticket = Ticket::create([
            'user_id' => $userId,
            'customer_id' => $request->customer_id,
            'price' => $request->price
        ]);
    
        //crea las ventas en la tabla sale por productos seleccionados
        $sale = new SaleController;
        $sale->salesStore($request,$ticket->id); //pasa el request para crear 1 x 1 y el ticket para la relacion en la tabla sales

        //hace la reduccion del stock de los productos actualizandolo
        $product = new ProductController;
        $product->stockReduction($request);

        //lo pone en deuda recien creado
        $debt = new DebtController;
        $debt->store($ticket);

        return redirect()->route('ticket.show',$ticket);


    }

    public function showtickets(){ //muestra todos los tickets
        $tickets = Ticket::orderby('id','desc')->paginate(20);
        return view('tickets.showtickets', compact('tickets'));
    }

    public function show(Ticket $ticket){//muestra el ticket seleccionado
        $sales = Sale::where('ticket_id',$ticket->id)->get();
        $debt = Debt::where('ticket_id',$ticket->id)->first();
        return view('tickets.show',compact('ticket','sales','debt'));
    }

    public function payment(Request $request, Ticket $ticket){ //actualiza los campos discount y total para completar el ticket
        $ticket->update([
            'discount' => $request->discount,
            'total' => ($ticket->price - $request->discount),
        ]);
        $ticket->debt->update([ // actuliza la tabla debt como pagada y registra que vendedor pago la deuda
            'cancel' => 1,
            'user_id' => Auth::id()
        ]);
        return redirect()->route('ticket.showtickets');

    }
}
