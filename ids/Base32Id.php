<?php

class Base32Id
{
	private string $doubleHexAlphabet = '0123456789abcdefghijklmnopqrstuv';
	private string $crockfordAlphabet = '0123456789ABCDEFGHKJMNPQRSTVWXYZ';

	public function __construct(private string $delimiter = '-') {}

	public function encode(int $decimal): string
	{
		// To PHP's Base32 (0-1, a-v).
		$defaultB32 = base_convert($decimal, 10, 32);

		// No ambiguous characters (I, L, O) and avoid obscenity (fUck, cUnt...)
		return strtr(
			$defaultB32,
			$this->doubleHexAlphabet,
			$this->crockfordAlphabet,
		);
	}

	public function decode(string $b32): int
	{
		// Fix formatting
		$b32 = strtoupper($b32);
		// Allow using I, L, O as 1, 1 and 0 respectively.
		$b32 = str_replace(['I', 'L',], '1', $b32);
		$b32 = str_replace('O', '0', $b32);
		$b32 = str_replace('U', '', $b32);

		// Convert to the Base32 that PHP wants.
		$defaultB32 = strtr(
			$b32,
			$this->crockfordAlphabet,
			$this->doubleHexAlphabet
		);

		// Decode and return this.
		return base_convert($defaultB32, 32, 10);
	}

	public function randomB32(int $length): string
	{
		$response = '';

		// Why not convert 32**$length?
		// Becuase that's sometimes too big for PHP to understand.
		for ($i = 0; $i < $length; $i++)
			$response .= $this->crockfordAlphabet[random_int(0, 31)];

		return $response;
	}

	public function generate(): string
	{
		// Hour-based timestamp, for shorter, still relevant ids.
		$hour = floor(time() / 3600);

		$id = $this->encode($hour);
		$id .= $this->delimiter;
		$id .= $this->randomB32(4);

		return $id;
	}
}
