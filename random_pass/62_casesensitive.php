<?php

// 8 bytes of entropy (https://en.wikipedia.org/wiki/Password_strength#Random_passwords)
$length = max(intval(@$argv[1]), 11);

$password = '';
for ($i=0; $i < $length; $i++)
	$password .= '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'[random_int(0, 61)];

echo $password, PHP_EOL;
