<?php

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


$dfOutput = shell_exec('df -h /');
echo "<pre>$dfOutput</pre>";


$total = shell_exec("df -h / | tail -n 1 | awk '{print $2}'");
echo "Espace total : " . trim($total);
?>
