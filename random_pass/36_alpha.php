<?php

// 8 bytes of entropy (https://en.wikipedia.org/wiki/Password_strength#Random_passwords)
$length = max(intval(@$argv[1]), 13);

$password = '';
for ($i=0; $i < $length; $i++)
	$password .= base_convert(random_int(0, 35), 10, 36);

echo $password, PHP_EOL;
