// resources/js/validacion.js

export function validarNumero(event) {
    const charCode = (event.which) ? event.which : event.keyCode;
    if (charCode != 46 && charCode != 45 && charCode > 31
        && (charCode < 48 || charCode > 57)) {
        event.preventDefault();
    }
}

export function validarNumeroOnInput(input) {
    const value = input.value;
    const regex = /^-?\d*\.?\d{0,2}$/;

    if (!regex.test(value)) {
        input.value = value.slice(0, -1);
    }
}


//script para ventas
document.addEventListener('DOMContentLoaded', function () {
    const addRowBtn = document.getElementById('addRowBtn');
    const cartTable = document.getElementById('cartTable').querySelector('tbody');

    addRowBtn.addEventListener('click', function () {
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>
                <select class="form-select" name="products[]">
                    <option selected disabled>Seleccione un producto</option>
                    
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    
                </select>
            </td>
            <td>
                <input type="number" class="form-control" name="quantities[]" value="1" min="1">
            </td>
            <td>
                <button type="button" class="btn btn-danger remove-row">Eliminar</button>
            </td>
        `;
        cartTable.appendChild(newRow);
    });

    cartTable.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-row')) {
            const row = e.target.closest('tr');
            row.remove();
        }
    });
});