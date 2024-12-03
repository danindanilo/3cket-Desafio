<?php 

    function var_dump_pretty($data){
        echo '<pre>' . var_export($data, true) . '</pre>';
    }

    function escapeSQL($string) {
        $string = addslashes($string); 
        return $string;
    }

    function compressImage($source, $destination) {

        $imgInfo = getimagesize($source);
        $mime = $imgInfo['mime'];
        $quality = 90;  // Initial quality (higher quality)
        $maxSizeKB = 200;  // Maximum target size in KB
    
        // Create a new image from file based on MIME type
        switch ($mime) {
            case 'image/jpeg':
            case 'image/jpg':
                $image = imagecreatefromjpeg($source);
                break;
            case 'image/png':
                $image = imagecreatefrompng($source);
                break;
            default:
                return false;  // Unsupported file type
        }
    
        // Resize the image if it's too large (optional but often helps in reducing size)
        $imageWidth = imagesx($image);
        $imageHeight = imagesy($image);
        $maxWidth = 1200;  // Maximum width in pixels
        $maxHeight = 1200; // Maximum height in pixels
    
        if ($imageWidth > $maxWidth || $imageHeight > $maxHeight) {
            $newWidth = $maxWidth;
            $newHeight = floor($imageHeight * ($maxWidth / $imageWidth));
    
            // If resizing based on width makes the height too big, resize based on height
            if ($newHeight > $maxHeight) {
                $newHeight = $maxHeight;
                $newWidth = floor($imageWidth * ($maxHeight / $imageHeight));
            }
    
            // Create a new image with the resized dimensions
            $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $imageWidth, $imageHeight);
            imagedestroy($image);
            $image = $resizedImage;
        }
    
        // Start compressing the image
        do {
            // Compress the image based on its type (JPEG or PNG)
            if ($mime == 'image/png') {
                // PNG compression (lossless)
                imagepng($image, $destination, 9 - ($quality / 10));  // Adjust quality for PNG
            } else {
                // JPEG compression
                imagejpeg($image, $destination, $quality);
            }
    
            // Check file size
            $fileSize = filesize($destination) / 1024;  // Convert to KB
    
            // Reduce quality if the size is still greater than max size
            if ($fileSize > $maxSizeKB) {
                $quality -= 10;  // Reduce quality more aggressively by 10 percent
            }
    
        } while ($fileSize > $maxSizeKB && $quality > 10);  // Stop if quality is too low
    
        // Clean up
        imagedestroy($image);
    
        // Return the path to the compressed image
        return $destination;
    }

    function image_resize($file, $w, $h, $crop=FALSE) {
        list($width, $height) = getimagesize($file);
        $src = imagecreatefromjpeg($file);
        $dst = imagecreatetruecolor($w, $h);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);

        return $dst;
    
    }
     
?>  