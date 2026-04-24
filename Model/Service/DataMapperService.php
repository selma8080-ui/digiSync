<?php
require 'Entity/DataServerEntity.php';
require 'vendor/autoload.php';

class DataMapperService {
    private $dataInfo = null;

    function _construct(){
        $dataInfo = new DataServerEntity();
    }

    public function getDataInfoJson(){
        self::getRam();
        self::getCpu();
        self::getSwap();
        self::getDisk();
        self::getTrafficDisque();
        self::getTrafficReseau();     

        //transformer en json_decode
        echo json_encode($dataInfo);
    }

    // Linux

    private function getRam() {
        /*
                        total        used        free      shared  buff/cache   available
        Mem:            3619         419        2494           5         785        3199
        Swap:           1024           0        1024/cache, available)*/

        exec('free -m', $output);


        $memLine = preg_split('/\s+/', $output[1]);

        $total = $memLine[1];
        $used = $memLine[2];
        $available = $memLine[6];

        $percent = ($used / $total) * 100;

        $dataInfo->ramTotal($total);
        $dataInfo->ramUsed($used);
        $dataInfo->ramAvailable($available);
    }

    private function getSwap() {
        /*
                    total        used        free      shared  buff/cache   available
        Mem:            3619         372        3140           5         185        3246
        Swap:           1024           0        1024
        */

        $free_output = shell_exec('free -m');

        preg_match('/Swap:\s+(\d+)\s+(\d+)\s+(\d+)/', $free_output, $matches);

        $totalSwap = $matches[1];
        $usedSwap  = $matches[2];

        $Spercent = ($usedSwap / $totalSwap) * 100;

        return [
                "total" => (int)$totalSwap,
                "used" => (int)$usedSwap,
                "free" => (int)$freeSwap,
                "percent" => round($Spercent, 2)
            ];
    }




    private function getDisk() {
    /*
    Filesystem      Size  Used Avail Use% Mounted on
    none            1.8G     0  1.8G   0% /usr/lib/modules/6.6.87.2-microsoft-standard-WSL2
    none            1.8G  4.0K  1.8G   1% /mnt/wsl
    drivers         238G  161G   78G  68% /usr/lib/wsl/drivers
    /dev/sdd       1007G  1.8G  954G   1% /
    none            1.8G   80K  1.8G   1% /mnt/wslg
    none            1.8G     0  1.8G   0% /usr/lib/wsl/lib
    rootfs          1.8G  2.7M  1.8G   1% /init
    none            1.8G  492K  1.8G   1% /run
    none            1.8G     0  1.8G   0% /run/lock
    none            1.8G     0  1.8G   0% /run/shm
    none            1.8G   76K  1.8G   1% /mnt/wslg/versions.txt
    none            1.8G   76K  1.8G   1% /mnt/wslg/doc
    C:\             238G  161G   78G  68% /mnt/c
    tmpfs           362M   20K  362M   1% /run/user/1000
    */


    exec('df -h /', $output);

    $line = preg_split('/\s+/', trim($output[1]));


    echo json_encode([
    "total" => $line[1],
    "used" => $line[2],
    "available" => $line[3],
    ]);
    }


    private function getCPU() {
    exec('vmstat 1 2', $output);

    /*
    procs -----------memory---------- ---swap-- -----io---- -system-- -------cpu-------
    r  b   swpd   free   buff  cache   si   so    bi    bo   in   cs us sy id wa st gu
    0  0      0 3410420   3488 153972    0    0    62   919   53    0  0  0 100  0  0  0
    0  0      0 3410420   3488 153972    0    0     0     0   41   48  0  0 100  0  0  0
    */


    $cpuLine = preg_split('/\s+/', trim($output[3]));

    $available = $cpuLine[14];
    $used = 100 - $available;

    echo json_encode([
    "total" => 100,
    "used" => $used,
    "available" => $available
    ]);

    }



    private function getTrafficDisque() {
    exec('vmstat 1 2', $output);

    /*
    procs -----------memory---------- ---swap-- -----io---- -system-- -------cpu-------
    r  b   swpd   free   buff  cache   si   so    bi    bo   in   cs us sy id wa st gu
    0  0      0 3409284   1036 159212    0    0    76   884   54    0  0  0 99  0  0  0
    0  0      0 3409312   1036 159212    0    0     0     0   36   41  0  0 100  0  0  0
    */

    $line = preg_split('/\s+/', trim($output[3]));

    $lecture = $line[8];
    $ecriture = $line[9];

    echo "Traffic Disque :\n";
    echo "Lecture (bi) : " . $lecture . " blocks/s\n";
    echo "Ecriture (bo) : " . $ecriture . " blocks/s\n";


    }

    private function getTrafficReseau() {

    /*
    Every 1.0s: cat /proc/net/dev | grep eth0                                     DESKTOP-N335JBU: Mon Apr 20 16:15:54 2026

    eth0: 133626359   59812    0    0    0     0          0        89  2088055   31173    0    0    0     0       0
        0
    */

    private function get_incoming_traffic($interface = 'eth0') {
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

    }



    echo json_encode([
        "ram" => getRam(),
        "swap" => getSwap(),
        "cpu" => getCPU(),
        "disque" => getDisk(),
        "traffDisque" => getTrafficDisque(),
        "traffReseau" => getTrafficReseau()
        
    ]);



    // MongoDB

    

    $client = new MongoDB\Client("mongodb://localhost:27017");
    $db = $client -> DigiS;
    $etablissment = $db->etablissment;

    $docs = $etablissment -> find();

    $totalSyncIn = 0;
    $totalSyncOut = 0;
    $totalCmdError = 0;
    $nbrEtablissement = 0;
}


    ?>