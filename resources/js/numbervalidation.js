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

