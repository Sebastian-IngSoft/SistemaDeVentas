@extends('adminlte::page')

@section('title', 'Caja')

@section('content_header')
    <h1>Caja</h1>
@stop

@section('content')

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#Operacion</th>
            <th scope="col">Saldo</th>
            <th scope="col">Flujo</th>
            <th scope="col">Fecha</th>
            <th scope="col">Motivo</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($wallets as $wallet)    
        <tr>
            <td>{{$wallet->id}}</td>
            <td>{{$wallet->balance}}</td>
            <td>{{$wallet->flow}}</td>
            <td>{{$wallet->created_at}}</td>
            <td>{{'test'}}</td>
        </tr>
        @endforeach
        
    </tbody>
</table>
@stop

@section('css')
    
@stop

@section('js')
    @vite(['resources/js/app.js', 'resources/js/bootstrap.bundle.min.js'])
@stop
