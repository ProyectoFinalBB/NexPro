<?php



function validarCI($ci) {
    // Verificar que la ci tenga 8 dígitos si o si:)
    if (strlen($ci) !== 8) {
        return false;
    }

    // sacar el número de la cédula
    $numero = "";
    for ($i = 0; $i < 7; $i++) {
        if ($ci[$i] < 1 || $ci[$i] > 9) {
            return false; 
        }
        $numero .= $ci[$i]; // agrega los números de la cédula a la variable numero uno x uno
    }
    $digito_verificador = $ci[7];

    
    $digito_verificador_esperado = calcularDigitoVerificador($numero);

   
    if ($digito_verificador == $digito_verificador_esperado) { // Compara el dígito verificador ingresado con el esperado
       
        return true; // si los dígitos verificadores son iguals entonces la cédula es valida
    } else {
        return false;
    }
}


function calcularDigitoVerificador($numero) {
   
    if (strlen($numero) !== 7) { // verificar que la cedula tenga 7 dígitos
        return false;
    }

    
    $multiplicadores = [2, 9, 8, 7, 6, 3, 4];// numeros que se multiplican para cada posicion 
    $suma = 0;

 
    for ($i = 0; $i < 7; $i++) {
        if ($numero[$i] < 0 || $numero[$i] > 9) {
            return false; // si encuentra un carácter que no es un numero tiene que retornar falso
        }
        $suma = $suma + ($numero[$i] * $multiplicadores[$i]);
    }


    $mayor_que_termina_en_0 = ceil($suma / 10) * 10; //ceil lo q hace es ponele 23.1 lo sube  a 24 directamente y multiplica x 10

    $digito_verificador = $mayor_que_termina_en_0 - $suma;

    return $digito_verificador;
}

?>