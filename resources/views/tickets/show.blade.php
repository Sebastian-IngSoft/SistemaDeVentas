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
        <div class="row">

            <button class="btn btn-danger w-25 mx-auto">Poner en deuda</button>
            <button class="btn btn-primary w-25 mx-auto">Registrar pago</button>
        </div>

    </div>

@stop

@section('css')
@stop

@section('js')
    @vite(['resources/js/app.js', 'resources/js/bootstrap.bundle.min.js'])
@stop
