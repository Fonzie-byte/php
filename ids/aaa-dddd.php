<?php

$code = '';

for ($a=0; $a<3; $a++)
	$code .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'[random_int(0, 25)];

$code .= '-';

for ($d=0; $d<4; $d++)
	$code .= random_int(0, 9);

echo $code, PHP_EOL;
