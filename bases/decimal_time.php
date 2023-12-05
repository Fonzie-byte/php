<?php

$totalHours = date('H') + date('i')/100 + date('s')/10_000;
$decimalTime = $totalHours/24;

$decimalHours = substr($decimalTime, 2, 1);
$decimalMinutes = substr($decimalTime, 3, 2);
$decimalSeconds = substr($decimalTime, 5, 2);

echo "$decimalHours:$decimalMinutes:$decimalSeconds\n";
