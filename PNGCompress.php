<?php

class PNGCompress{

    private $path_to_png_file;

    public function __construct($path_to_png_file)
    {
        $this->path_to_png_file = $path_to_png_file;
    }

    /**
     * @param $path_to_png_file
     * @return bool
     * @throws Exception
     * @author Mohamed Talaat <m.talaat377@gmail.com>
     */
    public function compress()
    {
        //check if file is exist
        if (!file_exists($this->path_to_png_file)) {
            throw new \Exception("File does not exist: $this->path_to_png_file");
        }
        try{
            //compress the image and overwrite the origin one
            @exec("/usr/bin/pngquant -f  --ext .png --quality=50-90  ".escapeshellarg($this->path_to_png_file));
        }
        catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
        return true;
    }
}