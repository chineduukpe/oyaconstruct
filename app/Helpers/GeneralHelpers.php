<?php

/*
* TAKES THE URL TO AN IMAGE AND COMPRESS IT TO A LOWER SIZE
* @param (String) source_url
* @param (String) destination_url
* @param (Integer) reduce_by => range: 1 to 100
*/
if (!function_exists('compress_image')) {
    function compress_image($source_url,$destination_url,$destination_urlreduce_by){
        $info = getimagesize($source_url);

        if ($info['mime'] == 'image/jpeg')
              $image = imagecreatefromjpeg($source_url);

        elseif ($info['mime'] == 'image/gif')
              $image = imagecreatefromgif($source_url);

      elseif ($info['mime'] == 'image/png')
              $image = imagecreatefrompng($source_url);

        imagejpeg($image, $destination_url, $quality);
    return $destination_url;
    }
}