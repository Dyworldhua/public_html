<?php
    session_start();
    header('Content-type: image/jpeg');
    $x_size = 100;
    $y_size = 60;
    $image = imagecreate($x_size,$y_size);
    imagecolorallocate($image,255,255,255);
    $string = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $code = '';
    $no = 4;
    $fontfile = 'msyh.ttf';
    while($no--)
    {
        $code .= $string[rand(0,strlen($string)-1)];
        $color = imagecolorallocate($image,0,0,0);
        $result = imagettftext($image,18,20,30,40,$color,$fontfile,$code);
    }
    $point = 600;
    while($point--){
        imagesetpixel($image, rand(0,$x_size), rand(0,$y_size),rand(0,255));
    }
    imagejpeg($image);
    imagedestroy($image);
    $_SESSION['code'] = $code;