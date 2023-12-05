<?php

$foundOptions = getopt('u:p::');

echo "Log in to unlock the Scroll of Truth.\n";

if (@$foundOptions['u'] === null)
	exit("Please pass a username (-u). Only t.parker may see the Scroll of Truth.\n");

if (@$foundOptions['p'] !== false)
	exit("A password (-p) is required!\n");

$password = readline('¶ ');

if (@$foundOptions['u'] !== 't.parker' || !password_verify($password, '$2y$10$jBFSuvPJ86/29PoNUAbcTuT6DL16Abf7ShnVI9GOdDO0eRexfPEe2'))
	exit("It has been decided that you are not the real t.parker, and thus have no access to the Scroll of Truth!\n");

echo "Curly brackets go on the next line.\n";

readline();

echo "Nyeeh!!\n";
