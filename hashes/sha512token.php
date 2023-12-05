<?php

$playerId = '64dcc2f4c9337664';   // uid() at 2023-08-16 12:37:08 UTC.
$characterId = '64dcc3a8b82b707e';   // uid() at 2023-08-16 12:40:08 UTC.

$inOneHour = time() + 3_600;

$toHash = "$playerId $characterId $inOneHour";
$hash = hash('sha512', $toHash);

$toEncrypt = "$toHash $hash";
$password = ";G+|L[@3(@=^^ <4;kI=ENHBGp\I,XBY";   // $stringGenerator->customFunction()
$encryptedToken = openssl_encrypt($toEncrypt, 'aes-256-ctr', $password, iv: '0000000000000000');

echo $encryptedToken, PHP_EOL;

// var_dump(openssl_decrypt($encryptedToken, 'aes-256-ctr', $password, iv: '0000000000000000'));
