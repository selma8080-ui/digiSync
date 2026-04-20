<?php 

exec('vmstat 1 2', $output);

/*
procs -----------memory---------- ---swap-- -----io---- -system-- -------cpu-------
 r  b   swpd   free   buff  cache   si   so    bi    bo   in   cs us sy id wa st gu
 0  0      0 3410420   3488 153972    0    0    62   919   53    0  0  0 100  0  0  0
 0  0      0 3410420   3488 153972    0    0     0     0   41   48  0  0 100  0  0  0
*/


$cpuLine = preg_split('/\s+/', trim($output[3]));

$disponible = $cpuLine[14]; 
$total = 100;

echo "Processeur Disponible: " . $disponible . "%\n";
echo "Processeur Total: 100%\n";

/*
<?php
function getCPUStats() {
    $data = file_get_contents('/proc/stat');
    $lines = explode("\n", $data);
    $cpu = preg_split('/\s+/', trim($lines[0]));

    // /proc/stat columns: user, nice, system, idle, iowait, irq, etc.
    $idle = $cpu[4];
    $total = array_sum(array_slice($cpu, 1));

    // Calculate percentage
    $percentDisponible = ($idle / $total) * 100;

    return [
        'disponible' => round($percentDisponible, 2),
        'total' => 100
    ];
}

$cpu = getCPUStats();
echo "CPU Disponible: " . $cpu['disponible'] . "%\n";
?>
*/



?>



