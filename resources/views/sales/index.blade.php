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
                    <select class="form-control w-100" id="customerSelect">
                        <option selected>Casual</option>
                        
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                        
                    </select>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <h5>Productos en canasta:</h5>
                <table class="table" id="cartTable">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Total</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select class="form-control w-100" name="products[]">
                                    <option selected>Seleccione un producto</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id}}" data-price="{{ $product->sell }}">{{ $product->name.' S/'.$product->sell }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" class="form-control" name="quantities[]" value="1" min="1">
                            </td>
                            <td class="product-total">
                                0.00
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger remove-row">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-primary" id="addRowBtn">Agregar Producto</button>
                    <h5>Total: <span id="grandTotal">0.00</span></h5>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    @vite(['resources/js/app.js', 'resources/js/bootstrap.bundle.min.js'])

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cartTable = document.getElementById('cartTable');
            const addRowBtn = document.getElementById('addRowBtn');
            const grandTotalElement = document.getElementById('grandTotal');

            function updateGrandTotal() {
                let grandTotal = 0;
                cartTable.querySelectorAll('tbody tr').forEach(row => {
                    const totalCell = row.querySelector('.product-total').textContent;
                    grandTotal += parseFloat(totalCell) || 0;
                });
                grandTotalElement.textContent = grandTotal.toFixed(2);
            }

            function resetRow(row) {
                row.querySelector('select[name="products[]"]').value = "";
                row.querySelector('input[name="quantities[]"]').value = 1;
                row.querySelector('.product-total').textContent = '0.00';
            }

            function addEventListeners(row) {
                row.querySelector('button.remove-row').addEventListener('click', function () {
                    const rows = cartTable.querySelectorAll('tbody tr');
                    if (rows.length > 1) {
                        row.remove();
                        updateGrandTotal();
                    }
                });

                row.querySelector('select[name="products[]"]').addEventListener('change', function () {
                    const productSelect = row.querySelector('select[name="products[]"]');
                    const quantityInput = row.querySelector('input[name="quantities[]"]');
                    const totalCell = row.querySelector('.product-total');
                    const price = productSelect.options[productSelect.selectedIndex].dataset.price || 0;
                    const quantity = quantityInput.value;
                    totalCell.textContent = (price * quantity).toFixed(2);
                    updateGrandTotal();
                });

                row.querySelector('input[name="quantities[]"]').addEventListener('input', function () {
                    const productSelect = row.querySelector('select[name="products[]"]');
                    const quantityInput = row.querySelector('input[name="quantities[]"]');
                    const totalCell = row.querySelector('.product-total');
                    const price = productSelect.options[productSelect.selectedIndex].dataset.price || 0;
                    const quantity = quantityInput.value;
                    totalCell.textContent = (price * quantity).toFixed(2);
                    updateGrandTotal();
                });
            }

            // Limpiar valores iniciales y establecer eventos
            cartTable.querySelectorAll('tbody tr').forEach(row => {
                resetRow(row);
                addEventListeners(row);
            });

            addRowBtn.addEventListener('click', function () {
                const newRow = cartTable.querySelector('tbody tr').cloneNode(true);
                resetRow(newRow);
                addEventListeners(newRow);
                cartTable.querySelector('tbody').appendChild(newRow);
            });
        });
    </script>
@stop
