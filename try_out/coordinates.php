<?php

$query = $argv[1] ?? 'United+Kingdom,Greenwich';
$url = 'https://nominatim.openstreetmap.org/search\?format\=json\&q\=' . $query;

$results = `curl $url 2>/dev/null`;
$results = json_decode($results);

if (empty($results)) {
	exit("$query was not found. Make sure you haven't made any typos.\n");
}

$lat = doubleval($results[0]?->lat);
$lon = doubleval($results[0]?->lon);

echo "$query was found at latitude $lat, longitude $lon\n";
