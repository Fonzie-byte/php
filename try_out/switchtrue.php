<?php

$ja = true;
$nee = false;
$yes = true;

echo match (true)
{
	$nee => 'Nee!' . PHP_EOL,
	$ja => 'Ja!' . PHP_EOL,
	$yes => 'Yes!' . PHP_EOL,
	default => 'Zijn we dan...' . PHP_EOL,
};
