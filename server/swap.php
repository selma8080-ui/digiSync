<?php
/*
               total        used        free      shared  buff/cache   available
Mem:            3619         372        3140           5         185        3246
Swap:           1024           0        1024
*/



$free_output = shell_exec('free -m');

preg_match('/Swap:\s+(\d+)\s+(\d+)\s+(\d+)/', $free_output, $matches);

$totalSwap = $matches[1];
$usedSwap  = $matches[2];

echo json_encode([
  "used" => (int)$usedSwap,
  "time" => time()
]);
?>



<!DOCTYPE html>
 <html lang="en">
 <head>

    <script src="https://cdn.jsdelivr.net/npm/vue@3"></script>
    <script src="https://cdn.jsdelivr.net/npm/echarts"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 </head>
 <body>

    <div id="app">
       <div id="chart" style="width:600px;height:400px;"></div>
    </div>

 <script>
let myChart = echarts.init(document.getElementById('chart'));

let data = [];



