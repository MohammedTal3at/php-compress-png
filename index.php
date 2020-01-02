<?php

$image_path = 'image.png';

$png_compress = new \PNGCompress($image_path);

try {
    $png_compress->compress();
    echo 'Compressed !';
}
catch (Exception $e){
    echo $e->getMessage();
}


