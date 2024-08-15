@extends('adminlte::page')

@section('title', 'Configuracion')

@section('content_header')
<h1>Usuarios</h1>

@stop

@section('content')
    
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Correo</th>
            <th scope="col">Fecha de creacion</th>
            <th scope="col">Fecha de actualizacion</th>
            <th scope="col">Operaciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->created_at}}</td>
            <td>{{$user->updated_at}}</td>
            <td>
                <form action="{{route('user.destroy',$user)}}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
@stop

@section('css')
    <!-- Puedes agregar tus estilos personalizados aquí -->
@stop

@section('js')

@stop
