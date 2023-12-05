<?php

$outcome = random_int(1, 6);

echo "You rolled " . match ($outcome) {
	1 => "the lowest",
	2 => "a two",
	3 => "a three",
	4 => "a four",
	5 => "a five",
	6 => "the highest",
	default => "something really weird",
} . " on a six-sided die!\n";
