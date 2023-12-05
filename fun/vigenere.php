<?php

// We'll use this down the line to print the characters.
$alphabet = "abcdefghijklmnopqrstuvwxyz";

// Wether we need to go up the alphabet (1, encode) or down (-1, decode). Default to "encode".
$direction = readline("Do you wish to [E]ncode or [d]ecode? ") === "d" ? -1 : 1;

// Ask them for the input, in a human way.
$input = readline("Please input the string to " . ($direction === 1 ? "en" : "de") . "code: ");

// Ask them for strictness (coded a-z only) or not (pass all chars, even non-encoded ones). Default to "no".
$strict = $direction !== 1 ? false : readline("Should it be coded stricly? (y/N) ") === "y";

// Ask them for the key.
$key = readline("Please input the key: ");
// Extract only letters, and make them all lowercase.
preg_match_all("/[a-z]/", strtolower($key), $matches);
// This is now our "cleaned up" key.
$key = implode("", $matches[0]);

// Start encoding!
$output = "";
$current = 0;
// Foreach character in the input-string...
foreach (str_split($input) as $character)
{
	// If we're not encoding stricly, remember if the character's uppercase.
	$is_uppercase = !$strict && ctype_upper($character);
	// See which letter it is (a=0 - z=25)
	$input_order = ord(strtolower($character)) - 97;

	// If it's not a letter, just add it to the output.
	if ($input_order < 0 || $input_order > 25)
	{
		// If we're not coding stricly, just add the non-letter to the output.
		if (!$strict)
			$output .= $character;
		continue;
	}

	// Actually coding? Grab the next character from the key, loop around if too much.
	$key_order = ord($key[$current%strlen($key)]) - 97;

	// Add the key, negative or positive depending on the direction, to the current order, loop around 26.
	$vigenere_order = ($input_order + $key_order * $direction)%26;
	// Find that character from our alphabet.
	$vigenere_character = $alphabet[$vigenere_order];
	// Add it to the output, reproducing uppercase.
	$output .= $is_uppercase? strtoupper($vigenere_character): $vigenere_character;

	// On to the next one...
	$current++;
}

echo $output, PHP_EOL;
