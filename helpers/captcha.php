<?php
    session_start();

    // $captcha_chars = md5(microtime());
    $captcha_chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghijkmnpqrstuvwxyz';
    $captcha_chars = substr(str_shuffle($captcha_chars), 0, 6);
    $_SESSION['code'] = $captcha_chars;

    $img = imagecreatetruecolor(80, 30);
    $theme = imagecolorallocate($img, 128, 0, 0);
    $white = imagecolorallocate($img, 255, 255, 255);
    $grey = imagecolorallocate($img, 150, 150, 150);

    imagefill($img, 10, 5, $theme);
    imagestring($img, 7, 5, 5,  $captcha_chars, $white);
    // imagestring($img, 6, 7, 7,  $captcha_chars, $grey);

    header("Cache-Control: no-cache, must-revalidate");
    header("Content-type: image/png");
    imagepng($img);
    imagedestroy($img);
?>
