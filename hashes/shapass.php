<?php

/*
 * This is an experiment.
 * This experiment is probably not a very good idea.
 * Please use PHP's built-in password_hash for real-world usage!
 */

$password = $argv[1] ?? '$l!?}v?A`3g!$b!",;F/';
$salt = bin2hex(random_bytes(16));
$rounds = $argv[2] ?? 10_000;

$startTime = microtime(true);
$hash = $salt.$password;
for ($i=0; $i < $rounds; $i++) { 
	$hash = hash('sha256', $hash);
}
$hash = "$salt:$hash";
$endTime = microtime(true) -$startTime;

$formattedRounds = number_format($rounds, 0, ',', '_');
$formattedTime = number_format($endTime, 2, ',', '_');
echo "$password salted and hashed $formattedRounds time(s) is $hash and took $formattedTime seconds.\n";
