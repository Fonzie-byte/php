<?php

/*
 * This is an experiment.
 * This experiment is probably not a very good idea.
 * Please use PHP's built-in password_hash for real-world usage!
 */

class PasswordHasher
{
	public function __construct(
		private readonly int $rounds = 100_000,
		private readonly string $algorithm = 'sha512',
		private readonly string $separator = ':'
	)
	{
		$this->ensureEnoughRounds($rounds);
		$this->ensureAlgorithmExists($algorithm);
		$this->ensureGoodSeparator($separator);
	}


	// ====== Public functions ====== \\
	public function hash(string $password, int $bytesOfSalt = 16): string
	{
		$this->ensureEnoughBytes($bytesOfSalt);

		$salt = bin2hex(random_bytes($bytesOfSalt));
		$hash = $this->hash_multiple($password . $salt, $this->rounds, $this->algorithm);

		return $this->format_hash($salt, $this->rounds, $this->algorithm, $hash);
	}

	public function verify(string $password, string $fullHash): bool
	{
		$hashData = explode($this->separator, $fullHash);
		$salt = $hashData[0];
		$rounds = $hashData[1];
		$algorithm = $hashData[2];

		$reproducedHash = $this->hash_multiple($password . $salt, $rounds, $algorithm);

		$toCompare = $this->format_hash($salt, $rounds, $algorithm, $reproducedHash);

		return $toCompare === $fullHash;
	}


	// ====== For cleaning up code ====== \\
	private function hash_multiple(string $input, int $rounds, string $algorithm): string
	{
		$hash = $input;
		for ($i = 0; $i < $rounds; $i++)
			$hash = hash($algorithm, $hash);

		return $hash;
	}

	private function format_hash(string $salt, string $rounds, string $algorithm, string $hash): string
	{
		return implode($this->separator, [
			$salt,
			$rounds,
			$algorithm,
			$hash,
		]);
	}


	// ====== Validation ====== \\
	private function ensureAlgorithmExists(string $algorithm): void
	{
		if (!in_array($algorithm, hash_algos()))
			die("Hashing algorithm $algorithm doesn't exist on this machine.\n");
	}

	private function ensureEnoughRounds(int $rounds): void
	{
		if ($rounds < 1)
			die("Rounds should be 1 or more.\n");
	}

	private function ensureGoodSeparator(string $separator): void
	{
		if (strlen($separator) !== 1)
			die("Enter exactly 1 character for the separator.\n");

		if (in_array($separator, [',', '-', '/', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y'])) {
			die("The separator $separator could cause confusion and is thus not allowed. Please try a different separator.\n");
		}
	}

	private function ensureEnoughBytes(int $bytesOfSalt): void
	{
		if ($bytesOfSalt < 1)
			die("Salt should be 1 byte or more.\n");
	}
}

function read_password(string $prompt = '', bool $hide = true): string
{
	echo $prompt;

	$s = $hide ? '-s' : '';
	$f = popen("read $s; echo \$REPLY", 'r');

	$input = fgets($f, 100);
	pclose($f);

	echo PHP_EOL;

	return trim($input);
}

// Script arguments
$shellOptions = getopt('p::b:r:a:s:');

if (@$shellOptions['p'] === false)
	$password = read_password('Password:', true);
else
	$password = '[SSKSlk1>Kd7V$5x`CS^';

$bytesOfSalt = intval(@$shellOptions['b'] ?? 16);
$rounds = intval(@$shellOptions['r'] ?? 100_000);
$algorithm = @$shellOptions['a'] ?? 'sha512';
$separator = @$shellOptions['s'] ?? ':';

$hasher = new PasswordHasher($rounds, $algorithm, $separator);

$timeStart = microtime(true);
$hash = $hasher->hash($password, $bytesOfSalt);
$timeTaken = microtime(true) - $timeStart;

echo "The salted hash is: $hash\n";
echo "This took $timeTaken seconds\n";

if ($hasher->verify($password, $hash))
	echo "The hash verifies correctly.\n";
else
	echo "\nThe hash COULDN'T be verified!\n";
