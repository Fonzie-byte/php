<?php

function getGravatarUrl(string $email): string
{
	// Trim leading and trailing whitespace from an email address and force all characters to lower case.
	$address = strtolower(trim($email));

	// Create an SHA256 hash of the final string.
	$hash = hash("sha256",$address);

	// Grab the actual image URL.
	return "https://www.gravatar.com/avatar/$hash";
}

echo getGravatarUrl($argv[1] ?? "john.doe@example.org"), PHP_EOL;
