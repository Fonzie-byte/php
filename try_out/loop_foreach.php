<?php

$users = [
	random_int(0, PHP_INT_MAX) => 'Anna',
	random_int(0, PHP_INT_MAX) => 'Bob',
	random_int(0, PHP_INT_MAX) => 'Christa',
];

// There seems to be no built-in way.
$loop = 0;
foreach ($users as $id => $user) {
	$loop++;
	echo "Run #$loop: User#$id = $user\n";
}
