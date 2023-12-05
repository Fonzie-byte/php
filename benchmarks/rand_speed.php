<?php

$start = (double)microtime();

for ($i = 0; $i < 1_000_000; $i++)
	$var = rand(0, PHP_INT_MAX);

$duration = (double)microtime() - $start;

echo 'rand() took ' . $duration . ' seconds.' . PHP_EOL;


$start = (double)microtime();

for ($i = 0; $i < 1_000_000; $i++)
	$var = random_int(0, PHP_INT_MAX);

$duration = (double)microtime() - $start;

echo 'random_int() took ' . $duration . ' seconds.' . PHP_EOL;
