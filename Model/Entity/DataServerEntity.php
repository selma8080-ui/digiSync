
<?php
    class DataServerEntity {
        //DISQUE
        public $hddTotal;
        public $hddUsed;
        public $hddAvailable;


        //CPU
        public $cpuUsed;
        public $cpuAvailable;

        //RAM
        public $ramTotal;
        public $ramUsed;
        public $ramAvailable;
        public $ramPercent;

        
        //SWAP
        public $swapTotal;
        public $swapUsed;


        //TRAFFIC_DISQUE
        public $trafficDisqueLecture;
        public $trafficDisqueEcriture;
 
        public $code_auth;
        public $date_last_sync;
        public $nbr_bug_in;
        public $nbr_bug_out;
        public $nbr_cmd_erreur;
        public $nbr_erreur_in;
        public $nbr_erreur_out;
        public $nbr_sync_in;
        public $nbr_sync_out;


        public $totalCodeAuth;
        public $totalBugIn;
        public $totalBugOut;
        public $totalCmdErreur;
        public $totalErreurIn;
        public $totalErreurOut;
        public $totalSyncIn;
        public $totalSyncOut;

        public $data;

}

?>

