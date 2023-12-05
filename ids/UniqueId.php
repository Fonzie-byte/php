<?php

class UniqueId
{
	/**
	 * Adds leading zeroes to the number and cuts up to a desired length.
	 *
	 * @param int|string $number The number to add leading zeroes to.
	 * @param int $length The length of the output, defaults to 8.
	 * @return string The number of the requested length.
	 */
	private static function limitNumberLength(int|string $number, int $length = 8): string
	{
		// Too long? Only the first characters.
		if (strlen($number) > $length)
			$number = substr($number, 0, $length);
		/*
		// Too short? Add '0's to the beginning.
		elseif (strlen($number) < $length)
			$number = str_pad($number, $length, '0', STR_PAD_LEFT);
		*/

		// Return whatever we adjusted. Or didn't. Just return it.
		return $number;
	}

	/**
	 * Generates a hexadecimal string with the first half consisting out of a
	 * timestamp and the second half consisting out of randomness.
	 * Precision of the timestamp depends on the ID length.
	 *
	 * @param int $length The length of the outputted ID.
	 * @return string The unique ID.
	 */
	public static function generate(int $length = 16): string
	{
		// Timestamp in seconds+microseconds, in hexadecimal.
		$time = dechex(microtime(true) * 1_000_000);
		// Cut to half the length, round down.
		$time = self::limitNumberLength($time, floor($length / 2));

		// Record the remainder characters we stil need.
		$lengthLeft = $length - strlen($time);

		// Random bytes, in hexadecimal.
		$rand = bin2hex(random_bytes(ceil($lengthLeft / 2)));
		// Cut to remaining length needed.
		$rand = self::limitNumberLength($rand, $lengthLeft);

		// Combine and return them.
		return $time . $rand;
	}
}

// To demonstrate; we'll run and display it here.
// You can add a number when you run this script, for your own ID length.
echo UniqueId::generate($argv[1] ?? 32), PHP_EOL;
