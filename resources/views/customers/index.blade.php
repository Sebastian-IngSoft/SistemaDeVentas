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
                    <form action="{{route('customer.store')}}" method="POST">
                        @csrf
                        <label>Nombre</label>
                        <input type="text" name="name" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default" required>

                        <label>DNI</label>
                        <input type="number" name="dni" step="any" class="form-control" onkeypress="validarNumero(event)"
                            oninput="validarNumeroOnInput(this)" required>

                        <label>Telefono</label>
                        <input type="number" name="number" step="any" class="form-control" onkeypress="validarNumero(event)"
                            oninput="validarNumeroOnInput(this)" required>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                </div>
            </div>
        </div>
    </div>



    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">DNI</th>
                <th scope="col">Telefono</th>
                <th scope="col">Operaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $item_customers)
                <tr>
                    <td>{{ $item_customers->name }}</td>
                    <td>{{ $item_customers->dni }}</td>
                    <td>{{ $item_customers->number }}</td>
                    <td>
                        <button type="button" class="btn btn-warning mb-3" data-bs-toggle="modal"
                            data-bs-target="#ModalEditar{{ $item_customers->id }}">
                            <i class="fas fa-pen-nib"></i>
                        </button>
                    </td>
                </tr>

                <!-- Modal editar-->
                <div class="modal fade" id="ModalEditar{{ $item_customers->id }}" data-bs-backdrop="static"
                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Cliente </h1>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('customer.update', $item_customers->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <label for="nombre">Nombre</label>
                                    <input type="text" name="name" class="form-control"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                                        value="{{ $item_customers->name }}" required>

                                    <label for="">DNI</label>
                                    <input type="number" name="dni" class="form-control"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                                        onkeypress="validarNumero(event)" oninput="validarNumeroOnInput(this)"
                                        value="{{ $item_customers->dni }}" required>

                                    <label for="">Telefono</label>
                                    <input type="number" name="number" step="any" class="form-control"
                                        onkeypress="validarNumero(event)" oninput="validarNumeroOnInput(this)"
                                        value="{{ $item_customers->number }}" required>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Editar</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            @endforeach
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
