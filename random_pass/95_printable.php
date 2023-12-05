<?php

// 8 bytes of entropy (https://en.wikipedia.org/wiki/Password_strength#Random_passwords)
$length = max(intval(@$argv[1]), 10);

$password = '';
for ($i=0; $i < $length; $i++)
	$password .= chr(random_int(32, 126));

echo $password, PHP_EOL;
