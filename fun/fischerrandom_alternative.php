<?php
/* [2023-03-10 15:20 (UTC)]
 * Also known as Chess960 ("chess nine-sixty").
 * This script returns a random, Fischer-random-valid board.
 */

$fileToPiece = [
	'a' => '♖',
	'b' => '♘',
	'c' => '♗',
	'd' => '♕',
	'e' => '♔',
	'f' => '♗',
	'g' => '♘',
	'h' => '♖',
];

function bishopsOnOppositeColours(string $shuffled): bool
{
	return (strpos($shuffled, 'c') - strpos($shuffled, 'f'))%2;
}

function kingBetweenRooks(string $shuffled): bool
{
	$rooks = [strpos($shuffled, 'a'), strpos($shuffled, 'h')];
	$king = strpos($shuffled, 'e');

	return $king > $rooks[0] && $king < $rooks[1];
}

$initial = 'abcdefgh';
do
	$shuffled = str_shuffle($initial);
while (!bishopsOnOppositeColours($shuffled) || !kingBetweenRooks($shuffled));

$pieces = '';
foreach (str_split($shuffled) as $file) {
	$pieces .= $fileToPiece[$file];
}
echo $pieces, PHP_EOL;
