<?php
// Mejorado con ChatGPT
function validarCI($ci) {
    // Verificar que la CI tenga 8 dígitos exactamente
    if (strlen($ci) !== 8 || !ctype_digit($ci)) {
        return false;
    }

    // Extraer los primeros 7 dígitos para el cálculo y el último como dígito verificador
    $numero = substr($ci, 0, 7);
    $digito_verificador = $ci[7];

    // Calcular el dígito verificador esperado
    $digito_verificador_esperado = calcularDigitoVerificador($numero);

    // Comparar el dígito verificador ingresado con el esperado
    return $digito_verificador == $digito_verificador_esperado;
}

function calcularDigitoVerificador($numero) {
    // Verificar que el número tenga exactamente 7 dígitos
    if (strlen($numero) !== 7 || !ctype_digit($numero)) {
        return false;
    }

    // Definir los multiplicadores para cada posición
    $multiplicadores = [2, 9, 8, 7, 6, 3, 4];
    $suma = 0;

    // Calcular la suma de los productos de cada dígito por su multiplicador
    for ($i = 0; $i < 7; $i++) {
        $suma += $numero[$i] * $multiplicadores[$i];
    }

    // Calcular el dígito verificador esperado
    $mayor_que_termina_en_0 = ceil($suma / 10) * 10;
    $digito_verificador = $mayor_que_termina_en_0 - $suma;

    return $digito_verificador;
}

?>
