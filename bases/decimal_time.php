<?php

$decimalHours = intval(date('H')/2.4);

$percentageOfHour = date('i')/60 + date('s')/3600;
var_dump($percentageOfHour);
$afterFloatingPoint = explode('.', $percentageOfHour)[1];
$decimalMinutes = substr($afterFloatingPoint, 0, 2);
$decimalSeconds = substr($afterFloatingPoint, 2, 2) ?? '00';

echo "$decimalHours:$decimalMinutes:$decimalSeconds\n";
