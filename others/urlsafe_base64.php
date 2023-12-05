<?php

class UrlSafeBase64
{
	public static function encode(mixed $value): string
	{
		// Encode to "unsafe" base64
		$result = base64_encode($value);

		// Convert "unsafe" base64 to urlsafe base64
		$result = strtr($result, '+/', '-_');

		// And without useless padding!
		return rtrim($result, '=');
	}

	public static function decode(string $value): string
	{
		// First convert urlsafe base64 to "unsafe" base64.
		$result = strtr($value, '-_', '+/');
		// Encode.
		$encoded = base64_decode($result);

		// if bool(false), then decoding wasn't possible.
		if ($encoded === false)
			throw new Exception('Please pass a value that can be converted to base64 in urlsafeBase64Encode.');

		// Are we still here? Then we can return the encoded result!
		return $encoded;
	}
}
