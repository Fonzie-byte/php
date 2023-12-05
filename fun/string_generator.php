<?php

class StringGenerator
{
	public function fromBase(int $length): string
	{
		// We may not be able to generate a number big enough in one go, so we'll do it in steps.
		$response = '';
		// As long as necessary...
		while (strlen($response) < $length) {
			// Generate a number as big as your PHP installation can generate.
			$randomNumber = random_int(0, PHP_INT_MAX);
			// Add it to the response.
			$response .= base_convert($randomNumber, 10, 36);
		}

		// Convert that from base 10 (all 10 digits) to base 36 (all 10 digits + all 26 letters)
		// 36 is also the highest base accepted by base_convert...
		return substr($response, 0, $length);
	}

	public function throughBase64(int $length = 16): string
	{
		// Generate random bytes (binary output, no text!) and encode that as base 64 string
		// Has all 10 digits, 26 lowercase letters, 26 uppercase letters and 2 characters (+ and /)
		// Pads with = if necessary.
		// *.75 because converting raw bytes to Base64 makes them 1/3 longer.
		return base64_encode(random_bytes(intval($length * .75)));
	}

	public function customFunction(int $length = 16, string $charset = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ `~!@#$%^&*()-=_+[]{};\'"\\|,./<>?'): string
	{
		// Will become the string to return.
		$string = '';
		// To make code more readable down the line
		$charsetLength = strlen($charset);

		// For as long as we want the string
		for ($c=0; $c < $length; $c++)
			// Add a random character from the charset
			$string .= $charset[random_int(0, $charsetLength-1)];

		// Return that string
		return $string;
	}
}

$stringGenerator = new StringGenerator;

// Read values from terminal arguments, but escape to own defaults.
$customLength = $argv[1] ?? 16;
$customLength = max(0, $customLength);
$customCharSet = empty($argv[2]) ?  '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ `~!@#$%^&*()-=_+[]{};\'"\\|,./<>?' : $argv[2];

echo "By base conversion; generates digits and lowercase letters:\n";
echo $stringGenerator->fromBase($customLength) . "\n\n";

echo "By base64-encoding random bytes; generates digits, lowercase letters, uppercase letters, plusses and forward slashes, might produce equals-signs.\n";
echo $stringGenerator->throughBase64(round($customLength)) . "\n\n";

echo "Using a custom function; generates the full keyboard layout, or what was passed through the terminal:\n";
echo $stringGenerator->customFunction($customLength, $customCharSet) . "\n\n";

echo "They are all cryptographically secure.\n";
