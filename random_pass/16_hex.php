<?php

// 8 bytes of entropy (https://en.wikipedia.org/wiki/Password_strength#Random_passwords)
$length = max(intval(@$argv[1]), 16);

$password = '';
for ($i=0; $i < $length; $i++)
	$password .= base_convert(random_int(0, 15), 10, 16);

echo $password, PHP_EOL;
