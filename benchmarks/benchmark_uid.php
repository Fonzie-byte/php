<?php

function uid(): string
{
	$hexTime = dechex(time());
	$random = bin2hex(random_bytes(4));

	return $hexTime.$random;
}

$start = microtime(true);

for ($i=0; $i < 100_000; $i++) {
	$uid = uid();
}

$duration = microtime(true) - $start;

echo "Took $duration seconds.\n";
