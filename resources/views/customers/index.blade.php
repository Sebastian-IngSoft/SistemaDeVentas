@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1>Clientes</h1>
@stop

@section('content')
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Nuevo Cliente
    </button>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Nuevo Cliente</h1>
                </div>
                <div class="modal-body">
                    <form action="">

                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default">

                        <label for="descripcion">DNI</label>
                        <input type="number" step="any" class="form-control" onkeypress="validarNumero(event)"
                            oninput="validarNumeroOnInput(this)">

                        <label for="stock_inicial">Telefono</label>
                        <input type="number" step="any" class="form-control" onkeypress="validarNumero(event)"
                            oninput="validarNumeroOnInput(this)">


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>


    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">DNI</th>
                <th scope="col">Telefono</th>
                <th scope="col">Operaciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td>@mdo</td>
            </tr>
        </tbody>
    </table>






@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    @vite(['resources/js/app.js', 'resources/js/bootstrap.bundle.min.js'])
@stop
