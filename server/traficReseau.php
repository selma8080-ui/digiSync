<?php

/*
Every 1.0s: cat /proc/net/dev | grep eth0                                     DESKTOP-N335JBU: Mon Apr 20 16:15:54 2026

  eth0: 133626359   59812    0    0    0     0          0        89  2088055   31173    0    0    0     0       0
    0
*/


function get_incoming_traffic($interface = 'eth0') {
    $stats = file_get_contents('/proc/net/dev');
    $lines = explode("\n", $stats);
    foreach ($lines as $line) {
        if (strpos($line, $interface) !== false) {
            $parts = preg_split('/\s+/', trim($line));
            return $parts[1]; 
        }
    }
    return 0;
}


$start = get_incoming_traffic('eth0');
sleep(1);
$end = get_incoming_traffic('eth0');
echo "Trafic entrant (1s) : " . ($end - $start) . " octets\n";
?>
