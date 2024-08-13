@extends('adminlte::page')

@section('title', 'Boletas')

@section('content_header')
    <h1>Boleta</h1>
@stop

@section('content')
    <div class="container">

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th colspan="6" class="text-center bg-secondary">DATOS BOLETA</th>
                </tr>
                <tr>
                    <th colspan="1" class="bg-secondary">#Boleta</th>
                    <td colspan="2">{{ $ticket->id }}</td>
                    <th colspan="1" class="bg-secondary">Fecha de emision</th>
                    <td colspan="2">{{ $ticket->created_at }}</td>
                </tr>
                <tr>
                    <th colspan="6" class="text-center bg-secondary">DATOS CLIENTE</th>
                </tr>
                <tr>
                    <th colspan="1" class="bg-secondary">Nombre</th>
                    <td colspan="1">{{ $ticket->customer->name ?? 'Cliente Casual' }}</td>
                    <th colspan="1" class="bg-secondary">DNI</th>
                    <td colspan="1">{{ $ticket->customer->dni ?? 'Cliente Casual' }}</td>
                    <th colspan="1" class="bg-secondary">Telefono</th>
                    <td colspan="1">{{ $ticket->customer->number ?? 'Cliente Casual' }}</td>
                </tr>
                <tr>
                    <th colspan="6" class="text-center bg-secondary">DATOS VENDEDOR</th>
                </tr>
                <tr>
                    <th colspan="1" class="bg-secondary">Nombre</th>
                    <td colspan="5">{{ $ticket->user->name }}</td>
                </tr>
                <tr>
                    <th colspan="6" class="text-center bg-secondary">COMPRA REALIZADA</th>
                </tr>
                <tr>
                    <th colspan="3" class="bg-secondary">Productos</th>
                    <th colspan="1" class="bg-secondary">Cantidad</th>
                    <th colspan="1" class="bg-secondary">Precio unitario</th>
                    <th colspan="1" class="bg-secondary">Total por producto</th>
                </tr>
                {{-- ! $ticket->sales->pluck('product')  --}}
                @foreach ($sales as $sale)
                    <tr>
                        <td colspan="3">{{ $sale->product->name }}</td>
                        <td colspan="1">{{ $sale->amount }}</td>
                        <td colspan="1">S/. {{ $sale->product->sell }}</td>
                        <td colspan="1">S/. {{ $sale->product->sell * $sale->amount }}</td>
                    </tr>
                @endforeach
                <tr>
                    <th colspan="5" class="bg-secondary">Total venta</th>
                    <td colspan="1">S/. {{ $ticket->price }}</td>
                </tr>
            </tbody>
        </table>

    </div>

    @if ($ticket->debt->cancel == 0)
        {{-- BOLETA EN DEUDA --}}
        <div class="row">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-warning mx-auto w-50 py-3 mt-4"" data-bs-toggle="modal"
                data-bs-target="#staticBackdrop">
                Pagar Boleta <i class="fas fa-hand-holding-usd"></i>
            </button>
        </div>
        <div class="row">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger mx-auto w-50 py-3 mt-4"" data-bs-toggle="modal"
                data-bs-target="#AnularBoleta">
                Anular Boleta <i class="fas fa-ban"></i>
            </button>
        </div>

        <!-- Modal Pagar boleta-->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Pagar Boleta</h1>
                    </div>
                    <form action="{{ route('ticket.payment', $ticket) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <label for="">Precio total</label>
                            <label id="total-price" class="form-control font-weight-normal">{{ $ticket->price }}</label>

                            <label for="">Hacer descuento</label>
                            <input type="number" name="discount" step="any" class="form-control" value="0"
                                onkeypress="validarNumero(event)"
                                oninput="validarNumeroOnInput(this); calculateFinalPrice();">

                            <label for="">Precio final de boleta</label>
                            <label id="final-price" class="form-control font-weight-normal">{{ $ticket->price }}</label>

                            <h5 class="font-weight-bold mt-5">Calcular vuelto</h2>
                                <label for="">Dinero recibido</label>
                                <input type="number" id="received-money" step="any" class="form-control" value=""
                                    onkeypress="validarNumero(event)"
                                    oninput="validarNumeroOnInput(this); calculateChange();">

                                <label for="">Dinero devuelto</label>
                                <label id="change" class="form-control font-weight-normal">0</label>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-warning">Pagar boleta</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal Anular boleta-->
        <div class="modal fade" id="AnularBoleta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Anular Boleta</h1>
                    </div>
                    <form action="{{ route('ticket.annular', $ticket) }}" method="POST">
                        <div class="modal-body">
                            @csrf

                            <h3>
                                ¿Seguro que desea anular la boleta?
                            </h3>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-danger">Anular boleta</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @elseif($ticket->debt->cancel == 1)
        {{-- BOLETA PAGADA --}}
        <div class="container">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th colspan="6" class="text-center bg-success">BOLETA LIQUIDADA</th>
                    </tr>
                    <tr>
                        <th colspan="1" class="bg-success">Precio boleta</th>
                        <td colspan="1" class=" ">S/. {{ $ticket->price }}</td>

                        <th colspan="1" class="bg-success">Descuento</th>
                        <td colspan="1" class="">S/. {{ $ticket->discount }}</td>

                        <th colspan="1" class="bg-success">Total</th>
                        <td colspan="1" class="">S/. {{ $ticket->total }}</td>
                    </tr>

                    <tr>
                        <th colspan="1" class="bg-success">Fecha de pago</th>
                        <td colspan="5" class="">{{ $ticket->debt->updated_at }}</td>
                    </tr>

                    <tr>
                        <th colspan="6" class="text-center bg-success">DATOS DEL REGISTRADOR</th>
                    </tr>


                    <tr>
                        <th colspan="1" class="bg-success">Nombre</th>
                        <td colspan="5" class="">{{ $debt->user->name }}</td>


                    </tr>
                </tbody>
            </table>
        </div>
    @elseif($ticket->debt->cancel == 2)
        {{-- BOLETA ANULADA --}}

        <div class="container">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th colspan="6" class="text-center bg-danger">BOLETA ANULADA</th>
                    </tr>

                    <tr>
                        <th colspan="1" class="bg-danger">Fecha de anulacion</th>
                        <td colspan="5" class="">{{ $ticket->debt->updated_at }}</td>
                    </tr>

                    <tr>
                        <th colspan="6" class="text-center bg-danger">DATOS DEL ANULADOR</th>
                    </tr>


                    <tr>
                        <th colspan="1" class="bg-danger">Nombre</th>
                        <td colspan="5" class="">{{ $debt->user->name }}</td>


                    </tr>
                </tbody>
            </table>
        </div>
    @endif
@stop

@section('css')
@stop

@section('js')
    @vite(['resources/js/app.js', 'resources/js/bootstrap.bundle.min.js'])

    <script>
        function calculateFinalPrice() {
            const totalPrice = parseFloat(document.getElementById('total-price').innerText);
            const discount = parseFloat(document.querySelector('input[name="discount"]').value);
            const finalPrice = totalPrice - discount;
            document.getElementById('final-price').innerText = finalPrice.toFixed(2);

            // Actualizar el cambio automáticamente si ya se ha ingresado el dinero recibido
            calculateChange();
        }

        function calculateChange() {
            const finalPrice = parseFloat(document.getElementById('final-price').innerText);
            const receivedMoney = parseFloat(document.getElementById('received-money').value);
            const change = receivedMoney - finalPrice;
            document.getElementById('change').innerText = change.toFixed(2);
        }
    </script>
@stop
