<?php
$uploaddir = 'uploads/';
$path      = $uploaddir . $_POST['name'] . '.jpg';
$im        = imagecreatefromjpeg($path);
$arr       = getimagesize($path);

const BIG_SIZE_HEIGHT    = 400;
const SMALL_SIZE_HEIGHT  = 150;

$arr = getimagesize($path);
/*
function resize($image, $new_height, $path, $width, $height)
{
   $new_width = round($new_height / $height * $width);
   $command    = "convert " . $image . " -resize \"" . $new_width . "x" . $new_height . "\" " . $path;
   exec($command);
   return $new_width;
}

$arr[1] = resize($path,
   BIG_SIZE_HEIGHT,
   $uploaddir . $_POST['name'] . '_b.jpg',
   $arr[0],
   $arr[1]);
$arr[1] = resize($path,
   SMALL_SIZE_HEIGHT,
   $uploaddir . $_POST['name'] . '_s.jpg',
   $arr[0],
   BIG_SIZE_HEIGHT);

*/
/*
function resize($image, $size, $path)
{
   $new_height = round($size / $image->getImageWidth() * $image->getImageHeight());
   $image->resizeImage($size, $new_height, Imagick::FILTER_LANCZOS, 1);
   $image->writeImage($path);
   return $image;
}

$image = new Imagick($path);
$image = resize($image, BIG_SIZE_WIDTH, $uploaddir . $_POST['name'] . '_b.jpg');
$image = resize($image, MIDDLE_SIZE_WIDTH, $uploaddir . $_POST['name'] . '_m.jpg');
$image = resize($image, SMALL_SIZE_WIDTH, $uploaddir . $_POST['name'] . '_s.jpg');
$image->clear();
$image->destroy();
*/
//big

$w = round(BIG_SIZE_HEIGHT / $arr[1] * $arr[0]);
$h = BIG_SIZE_HEIGHT;

$big = imagecreatetruecolor($w, $h);
imagecopyresampled($big, $im, 0, 0, 0, 0, $w, $h, $arr[0], $arr[1]);

//small

$im = $big;
$arr[0] = $w; $arr[1] = $h;

$w = round(SMALL_SIZE_HEIGHT / $arr[1] * $arr[0]);
$h = SMALL_SIZE_HEIGHT;

$small = imagecreatetruecolor($w, $h);
imagecopyresampled($small, $im, 0, 0, 0, 0, $w, $h, $arr[0], $arr[1]);

imagejpeg($big, $uploaddir . $_POST['name'] . '_b.jpg');
imagejpeg($small, $uploaddir . $_POST['name'] . '_s.jpg');

?>