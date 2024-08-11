@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    <h1>Productos</h1>
@stop

@section('content')
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Nuevo Producto
    </button>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Nuevo Producto</h1>
                </div>
                <div class="modal-body">
                    <form action="{{ route('product.store') }}" method="POST">
                        @csrf
                        <label for="nombre">Nombre</label>
                        <input type="text" name="name" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default" required>

                        <label for="descripcion">Descripción</label>
                        <input type="text" name="description" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default" required>

                        <label for="stock_inicial">Stock Inicial</label>
                        <input type="number" name="stock" class="form-control" aria-label="Sizing example input"
                            onkeypress="validarNumero(event)" oninput="validarNumeroOnInput(this)"
                            aria-describedby="inputGroup-sizing-default" required>

                        <label for="">Precio de Compra</label>
                        <input type="number" name="purchase" step="any" class="form-control"
                            onkeypress="validarNumero(event)" oninput="validarNumeroOnInput(this)" required>

                        <label for="">Precio de Venta</label>
                        <input type="number" name="sell" step="any" class="form-control"
                            onkeypress="validarNumero(event)" oninput="validarNumeroOnInput(this)" required>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
            </form>
        </div>
    </div>


    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Stock</th>
                <th scope="col">Compra</th>
                <th scope="col">Venta</th>
                <th scope="col">Operaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $item_products)
                <tr>
                    <td>{{ $item_products->name }}</td>
                    <td>{{ $item_products->description }}</td>
                    <td>{{ $item_products->stock }}</td>
                    <td>S/ {{ $item_products->purchase }}</td>
                    <td>S/ {{ $item_products->sell }}</td>
                    <td>
                        <button type="button" class="btn btn-warning mb-3" data-bs-toggle="modal"
                            data-bs-target="#ModalEditar{{ $item_products->id }}">
                            <i class="fas fa-pen-nib"></i>
                        </button>
                        <button type="button" class="btn btn-danger mb-3" data-bs-toggle="modal"
                            data-bs-target="#ModalEliminar{{ $item_products->id }}">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>

                <!-- Modal editar-->
                <div class="modal fade" id="ModalEditar{{ $item_products->id }}" data-bs-backdrop="static"
                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Producto </h1>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('product.update', $item_products->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <label for="nombre">Nombre</label>
                                    <input type="text" name="name" class="form-control"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                                        value="{{ $item_products->name }}" required>

                                    <label for="descripcion">Descripción</label>
                                    <input type="text" name="description" class="form-control"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                                        value="{{ $item_products->description }}" required>

                                    <label for="stock_inicial">Stock Inicial</label>
                                    <input type="number" name="stock" class="form-control"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                                        onkeypress="validarNumero(event)" oninput="validarNumeroOnInput(this)"
                                        value="{{ $item_products->stock }}" required>

                                    <label for="">Precio de Compra</label>
                                    <input type="number" name="purchase" step="any" class="form-control"
                                        onkeypress="validarNumero(event)" oninput="validarNumeroOnInput(this)"
                                        value="{{ $item_products->purchase }}" required>

                                    <label for="">Precio de Venta</label>
                                    <input type="number" name="sell" step="any" class="form-control"
                                        onkeypress="validarNumero(event)" oninput="validarNumeroOnInput(this)"
                                        value="{{ $item_products->sell }}" required>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Editar</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>

                <!-- Modal Eliminar -->
                <div class="modal fade" id="ModalEliminar{{ $item_products->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Producto
                                    {{ $item_products->name }}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ¿Seguro que desea eliminar el producto {{ $item_products->name }}?
                                <br>
                                El producto no se podra volver a visualizar.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <form action="{{ route('product.visibility', $item_products->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-danger">Eliminar producto</button>
                                </form>
                            </div>
                        </div>
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
