<?php

// Time in hexadecimal, which is 8 characters long.
$hexTime = dechex(time());
// 4 Cryptogaphically secure random bytes in hexadecimal, 8 characters long.
$random = bin2hex(random_bytes(4));

// Put them together and show them!
echo $hexTime . $random, PHP_EOL;
