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
                    <th scope="row">{{$ticket->id}}</th>
                    <td>{{$ticket->user->name}}</td>
                    <td>{{ $ticket->customer->name ?? 'Cliente casual no registrado' }}</td>
                    <td>{{$ticket->created_at}}</td>
                    <td>{{$ticket->price}}</td>
                    <td>
                        <a href="{{route('ticket.show',$ticket)}}" class="btn btn-primary">
                            <i class="far fa-eye"></i>
                        </a>
                    </td>
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
