<?php

$code = '';

for ($a=0; $a<3; $a++)
	$code .= ['ア','イ','ウ','エ','オ','カ','キ','ク','ケ','コ','ガ','ギ','グ','ゲ','ゴ','サ','シ','ス','セ','ソ','ザ','ジ','ズ','ゼ','ゾ','タ','チ','ツ','テ','ト','ダ','ヂ','ヅ','デ','ド','ナ','ニ','ヌ','ネ','ノ','ハ','ヒ','フ','ヘ','ホ','バ','ビ','ブ','ベ','ボ','パ','ピ','プ','ペ','ポ','マ','ミ','ム','メ','モ','ヤ','ユ','ヨ','ラ','リ','ル','レ','ロ','ワ','ン','ヲ'][random_int(0, 70)];

for ($d=0; $d<4; $d++)
	$code .= ['０','１','２','３','４','５','６','７','８','９'][random_int(0, 9)];

echo $code, PHP_EOL;
