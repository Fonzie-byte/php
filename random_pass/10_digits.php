<?php

// 8 bytes of entropy (https://en.wikipedia.org/wiki/Password_strength#Random_passwords)
$length = max(intval(@$argv[1]), 20);

$password = '';
for ($i=0; $i < $length; $i++)
	$password .= random_int(0, 9);

echo $password, PHP_EOL;
