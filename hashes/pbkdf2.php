<?php

$pass = $argv[1] ?? 'P@ssw0rd';
$salt = $argv[2] ?? bin2hex(random_bytes(16));
$iter = $argv[3] ?? 100_100;
$algo = $argv[4] ?? 'sha512';

$hash = hash_pbkdf2(
	algo: $algo,
	password: $pass,
	salt: $salt,
	iterations: $iter,
);

echo "$pass salted with $salt, hashed $iter times becomes $hash.\n";
