<?php
    require __DIR__ . '/../vendor/autoload.php';
    require __DIR__ . '/../Model/Service/DataMapperService.php';

    $dm = new DataMapperService();
    $totals = $dm->getTotals();
    $docs = $dm->getAllData();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <th>code auth</th>
                <th>nbr bug in</th>
                <th>nbr bug out</th>
                <th>nbr cmd erreur</th>
                <th>nbr erreur in</th>
                <th>nbr erreur out</th>
                <th>nbr sync in</th>
                <th>nbr sync out</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td><?= $totals["bug_in"] ?></td>
                <td><?= $totals["bug_out"] ?></td>
                <td><?= $totals["cmd_erreur"] ?></td>
                <td><?= $totals["erreur_in"] ?></td>
                <td><?= $totals["erreur_out"] ?></td>
                <td><?= $totals["sync_in"] ?></td>
                <td><?= $totals["sync_out"] ?></td>
            </tr>
        </tbody>
    </table>


    <table border="1">
        <thead>
            <tr>
                <th>code auth</th>
                <th>date last sync</th>
                <th>nbr bug in</th>
                <th>nbr bug out</th>
                <th>nbr cmd erreur</th>
                <th>nbr erreur in</th>
                <th>nbr erreur out</th>
                <th>nbr sync in</th>
                <th>nbr sync out</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($docs as $doc): ?>
                <tr>
                    <td><?= $doc["code_auth"] ?? "" ?></td>
                    <td><?= $doc["date_last_sync"] ?? "" ?></td>
                    <td><?= $doc["nbr_bug_in"] ?? 0 ?></td>
                    <td><?= $doc["nbr_bug_out"] ?? 0 ?></td>
                    <td><?= $doc["nbr_cmd_erreur"] ?? 0 ?></td>
                    <td><?= $doc["nbr_erreur_in"] ?? 0 ?></td>
                    <td><?= $doc["nbr_erreur_out"] ?? 0 ?></td>
                    <td><?= $doc["nbr_sync_in"] ?? 0 ?></td>
                    <td><?= $doc["nbr_sync_out"] ?? 0 ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


























</body>
</html>