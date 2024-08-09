<?php

function repartirCartas() {
    $palos = ["Corazones", "Diamantes", "Treboles", "Picas"];
    $valores = ["2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K", "As"];

    $mazo = [];
    foreach ($palos as $palo) {
        foreach ($valores as $valor) {
            $mazo[] = "$valor de $palo";
        }
    }

    shuffle($mazo);
    return array_slice($mazo, 0, 5);
}

function mostrarCartas($cartas) {
    foreach ($cartas as $carta) {
        echo $carta . "\n";
    }
}

function evaluarMano($cartas) {
    $palos = [];
    $valores = [];
    
    foreach ($cartas as $carta) {
        list($valor, $palo) = explode(' de ', $carta);
        $palos[] = $palo;
        $valores[] = $valor;
    }

    $frecuenciaValores = array_count_values($valores);
    $frecuenciaPalos = array_count_values($palos);
    $valoresOrdenados = array_keys($frecuenciaValores);
    $valoresOrdenados = array_map(function($valor) {
        switch ($valor) {
            case 'J': return 11;
            case 'Q': return 12;
            case 'K': return 13;
            case 'As': return 14;
            default: return (int)$valor;
        }
    }, $valoresOrdenados);
    sort($valoresOrdenados);
    
    $esColor = count($frecuenciaPalos) === 1;
    
    $esEscalera = ($valoresOrdenados[4] - $valoresOrdenados[0] === 4)
        || ($valoresOrdenados === [2, 3, 4, 5, 14]);
    
    if ($esColor && $esEscalera) {
        if ($valoresOrdenados === [10, 11, 12, 13, 14]) {
            echo "Escalera Real\n";
        } else {
            echo "Escalera de Color\n";
        }
    } elseif (in_array(4, $frecuenciaValores)) {
        echo "Póker\n";
    } elseif (in_array(3, $frecuenciaValores) && in_array(2, $frecuenciaValores)) {
        echo "Full House\n";
    } elseif ($esColor) {
        echo "Color\n";
    } elseif ($esEscalera) {
        echo "Escalera\n";
    } elseif (in_array(3, $frecuenciaValores)) {
        echo "Trío\n";
    } elseif (count(array_filter($frecuenciaValores, function($v) { return $v == 2; })) == 2) {
        echo "Dos Pares\n";
    } elseif (in_array(2, $frecuenciaValores)) {
        echo "Par\n";
    } else {
        echo "Carta Alta\n";
    }
}
$cartas = repartirCartas();
echo "Cartas repartidas:\n";
mostrarCartas($cartas);
echo "\nEvaluación de la mano:\n";
evaluarMano($cartas);

?>