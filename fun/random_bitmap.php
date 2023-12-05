<?php

// Courtesy of Bo Allen (https://boallen.com/random-numbers.html)

// Requires the GD Library
header("Content-type: image/png");
$im = imagecreatetruecolor(512, 512)
    or die("Cannot Initialize new GD image stream");
$white = imagecolorallocate($im, 255, 255, 255);
for ($y = 0; $y < 512; $y++) {
    for ($x = 0; $x < 512; $x++) {
        if (rand(0, 1)) {
            imagesetpixel($im, $x, $y, $white);
        }
    }
}
imagepng(image: $im, quality: 9);
imagedestroy($im);
