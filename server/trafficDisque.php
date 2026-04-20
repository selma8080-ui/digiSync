<?php 
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


/*
<?php
function getDiskStats($device = 'sda') {
    $stats = file_get_contents('/proc/diskstats');
    $lines = explode("\n", $stats);
    
    foreach ($lines as $line) {
        if (strpos($line, $device) !== false) {
            $fields = preg_split('/\s+/', trim($line));
            // Index 3 = sectors read, Index 7 = sectors written
            // Usually 1 sector = 512 bytes
            return [
                'read_sectors' => $fields[3],
                'write_sectors' => $fields[7]
            ];
        }
    }
    return null;
}

$disk = getDiskStats('sda'); // Change 'sda' to your disk name (lsblk to check)
echo "Secteurs lus: " . $disk['read_sectors'] . "\n";
echo "Secteurs ecrits: " . $disk['write_sectors'] . "\n";
?>
*/

?>