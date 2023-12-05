<?php

$array = [];

for ($i=0; $i < 20; $i++)
	$array[] = random_int(1, 100);
print_r($array);

function arrayAverage(array $input): float
{
	return array_sum($input) / count($input);
}

echo arrayAverage($array), PHP_EOL;
