<?php
include "PNGCompress.php";

if ( isset( $_FILES[ 'image' ] ) ) {
    $image_full_name = $_FILES['image']['name'];
    $ext = pathinfo($image_full_name, PATHINFO_EXTENSION);
    $base_name = explode('.',$image_full_name)[0];
    $dest = 'uploads/'.$base_name.'-'. rand(1,100).'.'.$ext;
    $new_dest = explode('.',$dest)[0] . '-compressed'.'.'.$ext;


    if ( move_uploaded_file( $_FILES[ 'image' ][ 'tmp_name' ] , $dest ) ) {
        $size_before = round(filesize($dest) / 1024);
        $png_compress = new PNGCompress( $dest , $new_dest );

        try {
                 if($png_compress->compress()){
                     echo  $new_dest;
                     $size_after = round(filesize($new_dest)/1024);
                 }
                 else
                     echo 'Something went wrong!';


        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Compress PMG</title>
</head>
<body>
    <div>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="image">Upload PNG Image</label>
            <input id="image" type="file" name="image" required>
            <input type="submit" value="Upload" name="submit" accept="image/png">
        </form>
        <?php if(isset($size_before) && isset($size_after) && isset($new_dest)) {?>
            <b style="color: red">Size Before : <?php echo $size_before?> kb</b><br>
            <b style="color: blue">Size After : <?php echo $size_after?> kb</b><br>
            <b style="color: green">Smaller By: <?php echo round(($size_after/$size_before)*100) . "%" ?></b><br>
            <img src="<?= $new_dest?>" alt="Compressed Image" >
        <?php } ?>
        <br>

    </div>
</body>
</html>


