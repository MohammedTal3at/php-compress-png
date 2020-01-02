<?php
include "PNGCompress.php";


$image_path = 'image.png';

$png_compress = new PNGCompress($image_path);

try {
    if($png_compress->compress()){
        echo 'Compressed!';
    }else{
        echo 'Something went wrong';
    }

}
catch (Exception $e){
    echo $e->getMessage();
}


