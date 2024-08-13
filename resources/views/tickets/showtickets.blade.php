@extends('adminlte::page')

@section('title', 'Boletas')

@section('content_header')
    <h1>Boletas Registradas</h1>
@stop

@section('content')

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#Boleta</th>
                <th scope="col">Hecha por</th>
                <th scope="col">Cliente</th>
                <th scope="col">Fecha</th>
                <th scope="col">Precio total</th>
                <th scope="col">Operaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tickets as $ticket)
                <tr>
                    <th scope="row">{{ $ticket->id }}</th>
                    <td>{{ $ticket->user->name }}</td>
                    <td>{{ $ticket->customer->name ?? 'Cliente casual no registrado' }}</td>
                    <td>{{ $ticket->created_at }}</td>
                    <td>{{ $ticket->price }}</td>
                    <td class="text-center">
                        <a href="{{ route('ticket.show', $ticket) }}"
                            class="btn btn-{{ $ticket->debt->cancel == 0 ? 'primary' : ($ticket->debt->cancel == 1 ? 'success' : 'danger') }} d-flex align-items-center justify-content-center"
                            style="width: 40px; height: 40px;">
                            @if ($ticket->debt->cancel == 0)
                                <i class="far fa-eye"></i>
                            @elseif($ticket->debt->cancel == 1)
                                <i class="fas fa-dollar-sign"></i>
                            @elseif($ticket->debt->cancel == 2)
                                <i class="fas fa-ban"></i>
                            @endif
                            {{-- El boton cambia de icono segun el estado del debt(deuda) --}}
                        </a>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $tickets->links() }}


@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    @vite(['resources/js/app.js', 'resources/js/bootstrap.bundle.min.js'])
@stop
