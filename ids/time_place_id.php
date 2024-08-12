<?php

function timePart(): string
{
	$floatTime = microtime(true);
	$intTime = intval($floatTime * 1_000_000);
	$hexTime = dechex($intTime);

	return $hexTime;
}

function placePart(string $query = 'United+Kingdom,Greenwich'): string
{
	$request = 'https://nominatim.openstreetmap.org/search\?format\=json\&q\=' . $query;

	$results = `curl $request 2>/dev/null`;
	$results = json_decode($results);

	if (empty($results)) {
		return bin2hex(random_bytes(4)) . '-' . bin2hex(random_bytes(4));
	}

	$doubleLat = doubleval($results[0]?->lat);
	$negLat = null;
	if ($doubleLat < 0) {
		$doubleLat = abs($doubleLat);
		$negLat = '0';
	}
	$intLat = intval($doubleLat * 1_000_000);
	$hexLat = dechex($intLat);

	$doubleLon = doubleval($results[0]?->lon);
	$negLon = null;
	if ($doubleLon < 0) {
		$doubleLon = abs($doubleLon);
		$negLon = '0';
	}
	$intLon = intval($doubleLon * 1_000_000);
	$hexLon = dechex($intLon);

	return "$negLat$hexLat-$negLon$hexLon";
}

echo timePart() . '-' . ($argv[2] ?? placePart($argv[1] ?? 'United+Kingdom,Greenwich')), PHP_EOL;
