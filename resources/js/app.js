import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


//importando validacion
import { validarNumero, validarNumeroOnInput } from './numbervalidation';

// Ahora puedes utilizar estas funciones en tu aplicación
window.validarNumero = validarNumero;
window.validarNumeroOnInput = validarNumeroOnInput;
