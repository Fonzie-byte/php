<?php

function randomElement(array $array): mixed
{
	return $array[random_int(0, count($array)-1)];
}

function generatePronounceableString(int $length = 8): string
{
	if ($length < 1)
		return '';

	$vowels = ['a', 'e', 'i', 'o', 'u', 'y'];
	$consonants =  ['b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'v', 'w', 'x', 'z'];

	$string = '';
	$onVowel = random_int(0, 1);
	for ($i=0; $i < $length; $i++)
	{
		$string .= $onVowel ? randomElement($vowels) : randomElement($consonants);
		$onVowel = !$onVowel;
	}

	return $string;
}

$length = intval(@$argv[1]);

if ($length < 1)
	$length = 8;

echo generatePronounceableString($length), PHP_EOL;
