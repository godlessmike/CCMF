<?php

namespace Core;

defined('ROOTPATH') OR die('ACCES DENIED');
/**
 * Image Class
 * 
 * @author Michał Borowiec <michal@cursed.pl>
 * @version 1.0 
 * @package Core\Image
 * 
 */

class Image {
    public function imageResize($filename, $maxSize = 700) : void {
            $type = mime_content_type($filename);
            if(file_exists($filename)) {
                switch($type) {
                    case 'image/png' : 
                        $image = imagecreatefrompng($filename);
                        break;
                    case 'image/gif' : 
                        $image = imagecreatefromgif($filename);
                        break;
                    case 'image/jpeg' : 
                        $image = imagecreatefromjpeg($filename);
                        break;
                    case 'image/webp' : 
                        $image = imagecreatefromwebp($filename);
                        break;
                    default:
                        return $filename;
                        break;
                }
                $sourceWidth = imagesx($image);
                $sourceHeight = imagesy($image);
                if($sourceWidth > $sourceHeight) {
                    if($sourceWidth < $sourceHeight) {
                        $maxSize = $sourceWidth;
                    }
                    $destinationWidth = $maxSize;
                    $destinationHeight = ($sourceHeight / $sourceWidth) * $maxSize;
                } else {
                    if($sourceHeight < $maxSize) {
                        $maxSize = $sourceHeight;
                    }

                    $destinationWidth = ($sourceWidth / $sourceHeight) * $maxSize;
                    $destinationHeight = $maxSize;

                    $destinationImage = imagecreatetruecolor($destinationWidth, $destinationHeight);
                   
                    if($type === 'image/png') {
                        imagealphablending($destinationImage, false);
                        imagesavealpha($destinationImage, true);
                    }

                    imagecopyresampled($destinationImage, $image, 0, 0, 0, 0, $destinationWidth, $destinationHeight, $sourceWidth, $sourceHeight);
                    imagedestroy($image);

                    switch($type) {
                        case 'image/png' :
                            imagepng($destinationImage, $filename, 8);
                            break;
                        case 'image/gif' :
                            imagegif($destinationImage, $filename);
                            break;
                        case 'image/jpeg' :
                            imagejpeg($destinationImage, $filename, 90);
                            break;
                        case 'image/webp' :
                            imagewebp($destinationImage, $filename, 90);
                            break;
                        default :
                            imagejpeg($destinationImage, $filename, 90);
                            break;
                    }
                    imagedestroy($destinationImage);
                }
                return $filename;
            }
    }
}