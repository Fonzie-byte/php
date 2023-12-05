<?php

/*
 * php -d MEMORY_LIMIT=8G -f bubble_sort.php
 * 1 000 items	Took 0.10419702529907 seconds.
 * 10 000 items	Took 11.362236022949 seconds.
 * 100 000 items	Fatal error: Allowed memory size exhausted in bubble_sort.php on line 21
 */

function bubble_sort(array $input): array
{
	$changed = false;
	for ($index=0; $index < count($input) - 1; $index++)
	{
		$item_current = $input[$index];
		$item_next = $input[$index + 1];

		if ($item_current > $item_next)
		{
			$input[$index + 1] = $item_current;
			$input[$index] = $item_next;
			$changed = true;
		}
	}

	if ($changed)
		return bubble_sort($input);

	return $input;
}
