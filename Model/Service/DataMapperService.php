<?php
    require __DIR__ . '/../../vendor/autoload.php';
    require __DIR__ . '/../Entity/DataServerEntity.php';
    use MongoDB\Client;


class DataMapperService {
    private $dataInfo = null;


    class DataMapperService {
        private $dataInfo = null;

        function __construct(){
            $this->dataInfo = new DataServerEntity();
        }

        public function getDataInfoJson(){
            $this->getRam();
            $this->getCpu();
            $this->getSwap();
            $this->getDisk();
            $this->getTrafficDisque();
            $this->getTrafficReseau();     

            echo json_encode($this->dataInfo);
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

            $this->dataInfo->ramTotal = $total;
            $this->dataInfo->ramUsed = $used;
            $this->dataInfo->ramAvailable = $available;
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

            $this->dataInfo->swapTotal = $totalSwap;
            $this->dataInfo->swapUsed = $usedSwap;
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

            $this->dataInfo->hddTotal = $line[1];
            $this->dataInfo->hddUsed = $line[2];
            $this->dataInfo->hddAvailable = $line[3];
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

            $this->dataInfo->cpuUsed = $used;
            $this->dataInfo->cpuAvailable = $available;

        }



        private function getTrafficDisque() {
            exec('vmstat 1 2', $output);
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

            $this->dataInfo->trafficDisqueLecture = $lecture;
            $this->dataInfo->trafficDisqueEcriture = $ecriture;
        }


        private function getTrafficReseau() {
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

        $dataInfo = new DataInfo();
        $dataInfo->trafficDisqueLecture($lecture);
        $dataInfo->trafficDisqueEcriture($ecriture);
    }



	
private function getTrafficReseau() {

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
                return (int)$parts[1];
            }


            $start = get_incoming_traffic('eth0');
            sleep(1);
            $end = get_incoming_traffic('eth0');

            $this->dataInfo->trafficReseau($end - $start);

        }


    $start = get_incoming_traffic('eth0');
    usleep(500000); 
    $end = get_incoming_traffic('eth0');

    $speed = $end - $start;

    header('Content-Type: application/json');

    echo json_encode([
        "value" => $speed
    ]);
}

        // MongoDB

        public function getTotals() {
            $client = new MongoDB\Client("mongodb://localhost:27017");
            $db = $client->DigiS;
            $etablissement = $db->etablissement;

            $docs = $etablissement->find();

            $totalCodeAuth = 0;   
            $totalBugIn = 0;
            $totalBugOut = 0;
            $totalCmdErreur = 0;
            $totalErreurIn = 0;
            $totalErreurOut = 0;
            $totalSyncIn = 0;
            $totalSyncOut = 0;

            foreach ($docs as $doc) {
                $totalCodeAuth++;
                $totalBugIn += (int)($doc["nbr_bug_in"] ?? 0);
                $totalBugOut += (int)($doc["nbr_bug_out"] ?? 0);
                $totalCmdErreur += (int)($doc["nbr_cmd_erreur"] ?? 0);
                $totalErreurIn += (int)($doc["nbr_erreur_in"] ?? 0);
                $totalErreurOut += (int)($doc["nbr_erreur_out"] ?? 0);
                $totalSyncIn += (int)($doc["nbr_sync_in"] ?? 0);
                $totalSyncOut += (int)($doc["nbr_sync_out"] ?? 0);
            }

            return [
                "code_auth" => $totalCodeAuth,
                "bug_in" => $totalBugIn,
                "bug_out" => $totalBugOut,
                "cmd_erreur" => $totalCmdErreur,
                "erreur_in" => $totalErreurIn,
                "erreur_out" => $totalErreurOut,
                "sync_in" => $totalSyncIn,
                "sync_out" => $totalSyncOut
            ];
        }

        public function getAllData() {
            $client = new MongoDB\Client("mongodb://localhost:27017");
            $db = $client->DigiS;
            $etablissement = $db->etablissement;

            return $etablissement->find();
        }

        
    }


?>