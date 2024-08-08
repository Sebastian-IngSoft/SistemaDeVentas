@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
    <h1>Ventas</h1>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <label for="customerSelect">
                    Cliente:
                </label>
                <div class="input-group mb-3">
                    <select class="form-select w-100" id="customerSelect">
                        <option selected>Casual</option>
                        {{--!
                        
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                        
                        --}}
                    </select>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <h5>Productos en canasta:</h5>
                <table class="table table-bordered" id="cartTable">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select class="form-select" name="products[]">
                                    <option selected disabled>Seleccione un producto</option>
                                    
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                                    @endforeach
                                    
                                </select>
                            </td>
                            <td>
                                <input type="number" class="form-control" name="quantities[]" value="1" min="1">
                            </td>
                            <td class="product-total">
                                0.00
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger remove-row">Eliminar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button type="button" class="btn btn-primary" id="addRowBtn">Agregar Producto</button>
            </div>
        </div>
    </div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cartTable = document.getElementById('cartTable');
            const addRowBtn = document.getElementById('addRowBtn');

            addRowBtn.addEventListener('click', function () {
                const newRow = cartTable.querySelector('tbody tr').cloneNode(true);
                newRow.querySelectorAll('input').forEach(input => input.value = 1);
                newRow.querySelector('.product-total').textContent = '0.00';
                cartTable.querySelector('tbody').appendChild(newRow);
            });

            cartTable.addEventListener('click', function (event) {
                if (event.target.classList.contains('remove-row')) {
                    const rows = cartTable.querySelectorAll('tbody tr');
                    if (rows.length > 1) {
                        event.target.closest('tr').remove();
                    }
                }
            });

            cartTable.addEventListener('change', function (event) {
                if (event.target.name === 'products[]' || event.target.name === 'quantities[]') {
                    const row = event.target.closest('tr');
                    const productSelect = row.querySelector('select[name="products[]"]');
                    const quantityInput = row.querySelector('input[name="quantities[]"]');
                    const totalCell = row.querySelector('.product-total');
                    const price = productSelect.options[productSelect.selectedIndex].dataset.price || 0;
                    const quantity = quantityInput.value;
                    totalCell.textContent = (price * quantity).toFixed(2);
                }
            });
        });
    </script>
@stop
