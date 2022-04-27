<?php
    function crop_image($file, $max_resolution){
        if(file_exists($file)){
            $original_image = imagecreatefrompng($file);

            $original_width = imagesx($original_image);
            $original_height = imagesy($original_image);

            if(($original_width - $original_height) >= 0){
                $ratio = $max_resolution / $original_height;
                $new_height = $max_resolution;
                $new_width = $original_width * $ratio;
                $dif = $new_width - $new_height;
                $x = round($dif / 2);
                $y = 0;
            }
            else{
                $ratio = $max_resolution / $original_width;
                $new_width = $max_resolution;
                $new_height = $original_height * $ratio;
                $dif = $new_height - $new_width;
                $x = 0;
                $y = round($dif / 2);
            }
            
        }

        if($original_image){

            $new_image = imagecreatetruecolor($new_width, $new_height);
            imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);

            $new_crop_image = imagecreatetruecolor($max_resolution, $max_resolution);
            imagecopyresampled($new_crop_image, $new_image, 0, 0, $x, $y, $max_resolution, $max_resolution, $max_resolution, $max_resolution);

            imagepng($new_crop_image, $file, 9);
            
        }
    }
