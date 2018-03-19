<?php

session_start(); //session开启

header("Content-type:img/png");


$im = imagecreate(100, 35);
imagecolorallocate($im, 255, 255, 255);
$black = imagecolorallocate($im, 150, 125, 133); //声明一个颜色
$text = "";

for ($i = 0; $i < 4; $i++) {
    $rnd = rand(0, 9);
    $text.= $rnd;
}

$_SESSION['code'] = $text;
$fontfile = './fonts/yuanyuan.ttf';
imagettftext($im, 20, 0, 13, 28, $black, $fontfile, $text);

for ($i = 0; $i < 15; $i++) {
    $color = imagecolorallocate($im, rand(100, 250), rand(10, 100), rand(200, 240));
    imageline($im, rand(0, 100), rand(0, 30), rand(0, 100), rand(0, 30), $color);
}


imagepng($im);
imagedestroy($im);
