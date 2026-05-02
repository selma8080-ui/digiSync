<?php

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../Entity/DataServerEntity.php';


class DataMapperService {

    private $info;

    function __construct() {
        $this->info = new DataServerEntity();
    }

    public function getDataInfoJson() {

        $this->getRam();
        $this->getCpu();
        $this->getSwap();
        $this->getDisk();
        $this->getTrafficDisque();
        $this->getTrafficReseau();
         $this->getTotals(); // ✅ now it fills info directly

    $this->info->data = $this->getAllData();

        header('Content-Type: application/json');
        echo json_encode($this->info);
    }

    // RAM 
    private function getRam() {

        $this->info->ramTotal = 16000;
        $this->info->ramUsed = rand(2000, 12000);
        $this->info->ramAvailable = $this->info->ramTotal - $this->info->ramUsed;

        $percent = ($this->info->ramUsed / $this->info->ramTotal) * 100;
        $this->info->ramPercent = round($percent);

        return;
    }

    //SWAP 
    private function getSwap() {

        $output = shell_exec('free -m');

        if (!$output) {
            $this->info->swapTotal = 0;
            $this->info->swapUsed = 0;
            return;
        }

        preg_match('/Swap:\s+(\d+)\s+(\d+)\s+(\d+)/', $output, $matches);

        $this->info->swapTotal = (int)($matches[1] ?? 0);
        $this->info->swapUsed = (int)($matches[2] ?? 0);
    }

    // DISK
    private function getDisk() {

        exec('df -h /', $output);

        if (empty($output) || !isset($output[1])) {
            $this->info->hddTotal = "500";
            $this->info->hddUsed = "400";
            $this->info->hddAvailable = "200";
            return;
        }

        $line = preg_split('/\s+/', trim($output[1]));

        $this->info->hddTotal = $line[1] ?? "0";
        $this->info->hddUsed = $line[2] ?? "0";
        $this->info->hddAvailable = $line[3] ?? "0";
    }

    // CPU 
    private function getCpu() {

        $this->info->cpuUsed = rand(10, 70);
        $this->info->cpuAvailable = 100 - $this->info->cpuUsed;
    }




private function getTrafficDisque() {
           // exec('vmstat 1 2', $output);


            
           // procs -----------memory---------- ---swap-- -----io---- -system-- -------cpu-------
           // r  b   swpd   free   buff  cache   si   so    bi    bo   in   cs us sy id wa st gu
             $output = "0  0      0 3409284   1036 159212    0    0    76   884   54    0  0  0 99  0  0  0
            0  0      0 3409312   1036 159212    0    0     0     0   36   41  0  0 100  0  0  0";
            

            $line = preg_split('/\s+/', trim($output));

            $lecture = $line[8];
            $ecriture = $line[9];

            $this->info->trafficDisqueLecture = $lecture;
            $this->info->trafficDisqueEcriture = $ecriture;
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

                    $this->info->trafficReseau($end - $start);

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
        }




            public function getTotals() {
                $client = new MongoDB\Client("mongodb://localhost:27017");
                $collection = $client->DigiS->etablissement;

                $this->info->totalCodeAuth = 0;
                $this->info->totalBugIn = 0;
                $this->info->totalBugOut = 0;
                $this->info->totalCmdErreur = 0;
                $this->info->totalErreurIn = 0;
                $this->info->totalErreurOut = 0;
                $this->info->totalSyncIn = 0;
                $this->info->totalSyncOut = 0;

                foreach ($collection->find() as $doc) {
                    $this->info->totalCodeAuth++;

                    $this->info->totalBugIn += (int)($doc['nbr_bug_in'] ?? 0);
                    $this->info->totalBugOut += (int)($doc['nbr_bug_out'] ?? 0);
                    $this->info->totalCmdErreur += (int)($doc['nbr_cmd_erreur'] ?? 0);
                    $this->info->totalErreurIn += (int)($doc['nbr_erreur_in'] ?? 0);
                    $this->info->totalErreurOut += (int)($doc['nbr_erreur_out'] ?? 0);
                    $this->info->totalSyncIn += (int)($doc['nbr_sync_in'] ?? 0);
                    $this->info->totalSyncOut += (int)($doc['nbr_sync_out'] ?? 0);
                }
            }


            public function getAllData() {
                $client = new MongoDB\Client("mongodb://localhost:27017");
                $db = $client->DigiS;
                $collection = $db->etablissement;

                $data = [];

                foreach ($collection->find() as $doc) {
                    $data[] = [
                        'code_auth' => $doc['code_auth'] ?? '',
                        'date_last_sync' => isset($doc['date_last_sync']) ? date('Y-m-d H:i:s', $doc['date_last_sync']->toDateTime()->getTimestamp()) : null,
                        'nbr_bug_in' => $doc['nbr_bug_in'] ?? 0,
                        'nbr_bug_out' => $doc['nbr_bug_out'] ?? 0,
                        'nbr_cmd_erreur' => $doc['nbr_cmd_erreur'] ?? 0,
                        'nbr_erreur_in' => $doc['nbr_erreur_in'] ?? 0,
                        'nbr_erreur_out' => $doc['nbr_erreur_out'] ?? 0,
                        'nbr_sync_in' => $doc['nbr_sync_in'] ?? 0,
                        'nbr_sync_out' => $doc['nbr_sync_out'] ?? 0,
                    ];
                }

                return $data;
            }

                


    }

            // ================= EXECUTE API =================
            $service = new DataMapperService();
            $service->getDataInfoJson();