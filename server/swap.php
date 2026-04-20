<?php
/*
               total        used        free      shared  buff/cache   available
Mem:            3619         372        3140           5         185        3246
Swap:           1024           0        1024
*/




$free_output = shell_exec('free -m');


if (preg_match('/Swap:\s+(\d+)\s+(\d+)\s+(\d+)/', $free_output, $matches)) {
    $totalSwap = $matches[1];
    $usedSwap  = $matches[2]; 
    $freeSwap  = $matches[3]; 

    echo "Total Swap: " . $totalSwap . " Mo\n";
    echo "Utilisé Swap: " . $usedSwap . " Mo\n";
    echo "Disponible Swap: " . $freeSwap . " Mo\n";
} else {
    echo "Impossible de récupérer les informations de Swap.";
}
?>
