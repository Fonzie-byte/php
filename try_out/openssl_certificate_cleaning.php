<?php

function stripPrivateKey(string $fullPrivateKey): string
{
	if (!str_contains($fullPrivateKey, 'PRIVATE KEY')) {
		throw new \Exception('The input must be a private key.');
	}

	// Remove the header and footer.
	$keyContents = preg_replace('/^.*BEGIN PRIVATE KEY.*$/m', '', $fullPrivateKey);
	$keyContents = preg_replace('/^.*END PRIVATE KEY.*$/m', '', $keyContents);

	// Return as one long string.
	return str_replace("\n", '', $keyContents);
}


function splitCertificateChain(string $fullCertificateChain): string[]
{
	if (!str_contains($fullCertificateChain, 'CERTIFICATE')) {
		throw new \Exception('The input must be an OpenSSL certificate or OpenSSL certificate chain.');
	}

	$certificateChainArray = [];
	while (str_contains($fullCertificateChain, 'BEGIN CERTIFICATE')) {
		$begin = strpos($fullCertificateChain, "\n");
		$end = strpos($fullCertificateChain, "\n-----END CERTIFICATE");
		$toAdd = substr($fullCertificateChain, $begin + 1, $end - $begin);
		$toAdd = str_replace("\n", '', $toAdd);
		$fullCertificateChainsArray[] = $toAdd;
		$fullCertificateChain = substr($fullCertificateChain, strpos($fullCertificateChain, "END CERTIFICATE-----\n") + 21);
	}
	$fullCertificateChain = json_encode($certificateChainArray);
}
