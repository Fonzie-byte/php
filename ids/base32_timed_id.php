<?php

require_once 'Base32Id.php';

$b32Id = new Base32Id($argv[1] ?? '-');

// To demo; show a new base32Id, splitting by terminal argument, by - if not given.
echo $b32Id->generate(), PHP_EOL;
