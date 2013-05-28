<?php
    if (! function_exists('ResizeImage'))
    {
        function ResizeImage($sourceImage, $suffix=null, $imageHeight, $imageWidth, $aspectRatio = null)
        {
            $CI =& get_instance();
            $imagesInfo = pathinfo($sourceImage);
            $imageFiles = $imagesInfo['dirname']."/".$imagesInfo['filename'].".".$imagesInfo['extension'];
            $newImageFiles =  $imagesInfo['dirname']."/".$imagesInfo['filename'].$suffix.".".$imagesInfo['extension'];
            if(file_exists($imageFiles))
            {
                $config['image_library']    = 'gd2';
                $config['source_image']     = $imageFiles;
                $config['maintain_ratio']   = ($aspectRatio != null) ? $aspectRatio: true;
                $config['new_image']        = ($suffix != null)?$newImageFiles:$imageFiles;
                $config['width']            = $imageWidth;
                $config['height']           = $imageHeight;
                $CI->load->library('image_lib');
                $CI->image_lib->initialize($config); 
                $CI->image_lib->resize();
                $CI->image_lib->clear();
            }
        }
    }
    
?>