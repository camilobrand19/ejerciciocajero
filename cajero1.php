<?php

function cajero() {
    $claveCorrecta = '1908'; 
    $saldo = 500000; 
    $claveIngresada = '';

    while ($claveIngresada !== $claveCorrecta) {
        $claveIngresada = readline("Ingrese su clave: ");

        if ($claveIngresada !== $claveCorrecta) {
            echo "Clave incorrecta intente de nuevo.\n";
        }
    }

    $opcion = '';
    while ($opcion !== '3') {
        echo "\nSaldo actual: $$saldo\n";
        echo "\nBienvenido\n";
        echo "Seleccione transaccion que desea realizar: \n";
        echo "1. Consignar\n";
        echo "2. Retirar\n";
        echo "3. Salir\n";
        $opcion = readline("Seleccione una opción: ");

        switch ($opcion) {
            case '1': 
                $cantidadConsignar = (float) readline("Ingrese la cantidad a consignar: ");
                if ($cantidadConsignar > 0) {
                    $saldo += $cantidadConsignar;
                    echo "Se han consignado $$cantidadConsignar.\n";
                } else {
                    echo "La cantidad debe ser mayor que 0.\n";
                }
                break;

            case '2': 
                $cantidadRetirar = (float) readline("Ingrese la cantidad a retirar: ");
                if ($cantidadRetirar > 0 && $cantidadRetirar <= $saldo) {
                    $saldo -= $cantidadRetirar;
                    echo "Se han retirado $$cantidadRetirar.\n";
                } elseif ($cantidadRetirar > $saldo) {
                    echo "Saldo insuficiente.\n";
                } else {
                    echo "La cantidad debe ser mayor que 0.\n";
                }
                break;

            case '3': 
                echo "Gracias por usar el cajero.\n";
                break;

            default:
                echo "Opción no válida. Intente de nuevo.\n";
        }
    }

    echo "Saldo final: $$saldo\n";
}

cajero();

?>

