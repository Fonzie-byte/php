<?php

// Courtesy of php.net.

$timeTarget = 0.05; // 50 milliseconds

$cost = 0;
do {
	$cost++;
	$start = microtime(true);
	password_hash('B9Dbg\\?)]#pP|UrY#UYW', PASSWORD_ARGON2ID, ['time' => $cost]);
	$end = microtime(true);
} while (($end - $start) < $timeTarget);

echo "Appropriate Cost Found: $cost.\n";
