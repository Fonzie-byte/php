<?php
/* [2023-03-10 14:40 (UTC)]
 * Also known as Chess960 ("chess nine-sixty").
 * This script returns a random, Fischer-random-valid board.
 */

$whiteToBlack = [
	'♙' => '♟︎',
	'♘' => '♞',
	'♗' => '♝',
	'♖' => '♜',
	'♕' => '♛',
	'♔' => '♚',
];

function bishopsOnOppositeColours(array $pieces): bool
{
	$locations = array_keys($pieces, '♗');

	return $locations[0]%2 xor $locations[1]%2;
}

function kingBetweenRooks(array $pieces): bool
{
	$rooks = array_keys($pieces, '♖');
	$king = array_keys($pieces, '♔')[0];

	return $king > $rooks[0] && $king < $rooks[1];
}

function shufflePieces(): array
{
	$pieces = ['♘', '♘', '♗', '♗', '♖', '♖', '♕', '♔'];

	do
		shuffle($pieces);
	while (
		!bishopsOnOppositeColours($pieces) ||
		!kingBetweenRooks($pieces)
	);

	return $pieces;
}

$white = shufflePieces();

if (@$argv[1] === 'minimal')
	echo implode('', $white), PHP_EOL;
else {
$black = [];
	foreach ($white as $piece)
		$black[] = $whiteToBlack[$piece];

	echo '8 ' . implode(' ', $black) . PHP_EOL .
		'7 ' . '♟︎ ♟︎ ♟︎ ♟︎ ♟︎ ♟︎ ♟︎ ♟︎' . PHP_EOL .
        	'6 ' . PHP_EOL .
        	'5 ' . PHP_EOL .
        	'4 ' . PHP_EOL .
        	'3 ' . PHP_EOL .
        	'2 ' . '♙ ♙ ♙ ♙ ♙ ♙ ♙ ♙' . PHP_EOL .
        	'1 ' . implode(' ', $white) . PHP_EOL .
        	'  a b c d e f g h' . PHP_EOL;
}
