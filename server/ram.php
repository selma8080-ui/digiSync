<?php
exec('free -m', $output);

/*
                total        used        free      shared  buff/cache   available
Mem:            3619         419        2494           5         785        3199
Swap:           1024           0        1024/cache, available)*/

$memLine = preg_split('/\s+/', $output[1]);

$total = $memLine[1];
$used = $memLine[2];
$available = $memLine[6];

echo "RAM Totale: " . $total . " Mo\n";
echo "RAM Utilisée: " . $used . " Mo\n";
echo "RAM Disponible: " . $available . " Mo\n";
?>
