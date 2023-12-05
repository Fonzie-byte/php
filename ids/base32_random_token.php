<?php

require_once 'Base32Id.php';

$delimiter = $argv[1] ?? '-';
$rounds = intval($argv[2] ?? '2');
$length = intval($argv[3] ?? '4');
$b32Id = new Base32Id();

// To demo; show a new base32Id, splitting by terminal argument, by - if not given.
$parts = [];
for ($i=0; $i < $rounds; $i++)
	$parts[] = $b32Id->randomB32($length);
echo implode($delimiter, $parts), PHP_EOL;
