<?php

$array = [];
for ($i=0; $i < random_int(19, 20); $i++)
	$array[] = random_int(1, 100);
print_r($array);

function arrayMedian(array $input): float
{
	sort($input);
	$length = count($input);
	$middle = $length/2;

	if ($length%2)
		return $input[floor($middle)];
	else
		return ($input[$middle - 1] + $input[$middle])/2;
}

echo arrayMedian($array), PHP_EOL;
