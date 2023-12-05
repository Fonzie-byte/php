<?php

/**
 * For better legibility down the line.
 */
function rand32(): int
{
	return random_int(0, 31);
}

/**
 * Converts to base32, in our custom alphabet.
 */
function to32(int $decimal): string
{
	static $defaultAlphabet = '0123456789abcdefghijklmnopqrstuv';
	// This skips ILOU to prevent confusion.
	static $crockfordAlphabet = '0123456789ABCDEFGHKJMNPQRSTVWXYZ';

	// Make regular base32, first.
	$regularBase32 = base_convert($decimal, 10, 32);

	// Translate that to our unconfusable alphabet.
	return strtr($regularBase32, $defaultAlphabet, $crockfordAlphabet);
}

/**
 * Converts the given integer to a single "base37" character.
 * 37 being the least greater prime to 32, to minimise collisions.
 */
function toChecksumChar(int $decimal): string
{
	if ($decimal < 0 || $decimal >= 37)
		throw new Exception('Supported checksum values are 0-36 (both inclusive).');

	// Additional characters accodomodate to "base37".
	// These shouldn't conflict with URLs or common punctuation.
	static $crockfordChecksumAlphabet = '0123456789ABCDEFGHKJMNPQRSTVWXYZ*~$=U';

	return $crockfordChecksumAlphabet[$decimal];
}

/**
 * Generates the ID, number of parts, divider and prefixes configurable.
 *
 * @param int $rounds How many parts should be generated (including the prefixes), defaults to 2.
 * @param string $divider What divides the parts, defaults to '-'.
 * @param array $prefixes The ID will starts with these parts.
 */
function b32Id(int $rounds = 2, string $divider = '-', array $prefixes = []): string
{
	// Start with the given prefixes.
	$parts = $prefixes;
	// Generate that many parts less.
	$rounds -= count($prefixes);

	// For as many as still needed...
	for ($i=0; $i < $rounds; $i++) {
		// Generate 3 random characters.
		$x = rand32();
		$y = rand32();
		$z = rand32();

		// Generate a fourth checksum character.
		// x + y×2 + z×3 was chosen so that each combination of xyz has a
		// unique checksum.
		// This is modulated by 37, the least greater prime to 32.
		$checksum = ($x + $y*2 + $z*3)%37;

		// Put these together, in our custom base32, make that a part.
		$parts[] = to32($x) .
		to32($y) .
		to32($z) .
		toChecksumChar($checksum);
	}

	// Returns the prefixes and generated parts, divided by the given divider.
	return strtoupper(implode($divider, $parts));
}

$options = getopt('r:d:p:', [
	'rounds:',
	'divider:',
	'prefixes:',
]);

$rounds = @$options['rounds'] ?? @$options['r'] ?? 2;
$divider = @$options['divider'] ?? @$options['d'] ?? '-';

$prefixes = [];
if (isset($options['prefixes']))
	$prefixes = explode(' ', $options['prefixes']);
else if (isset($options['p']))
	$prefixes = explode(' ', $options['p']);

// Show them our wonderful ID!
echo b32Id($rounds, $divider, $prefixes), PHP_EOL;
