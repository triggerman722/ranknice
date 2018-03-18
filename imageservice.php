<?php

define("ALIGN_LEFT", "left");
define("ALIGN_CENTER", "center");
define("ALIGN_RIGHT", "right");
define("VALIGN_TOP", "top");
define("VALIGN_MIDDLE", "middle");
define("VALIGN_BOTTOM", "bottom");

class ImageService {

function buildimage($fvsImageTitle, $fvsImageCount, $fvsPrefix = NULL, $fvsSuffix = NULL) {
	$tvsImageName = "/var/www/html/images/600400/".mt_rand(1,10).".jpg";
	$tviImage = imagecreatefromstring(self::getImage($tvsImageName));

//	$tvcBackground = imagecolorallocate($tviImage, mt_rand(50,200), mt_rand(50,200), mt_rand(50,200));
//	imagefill($tviImage, 0, 0, $tvcBackground);

	$tvcForeground = imagecolorallocate($tviImage, 255, 255, 255);
	$tvcForegroundShadow = imagecolorallocate($tviImage, 25, 25, 25);

	$tvsFontPath = "/var/www/html/fonts/DroidSans.ttf";
	$tviFontSize = 100;

//	imagettftext($tviImage, 25, 0, 12, 152, $tvcForegroundShadow, $tvsFontPath, $fvsImageTitle);
//	imagettftext($tviImage, 25, 0, 10, 150, $tvcForeground, $tvsFontPath, $fvsImageTitle);

	$tvsImageCount = $fvsPrefix.self::condenseCount($fvsImageCount).$fvsSuffix;

	$tvaDimensions = imagettfbbox($tviFontSize, 0, $tvsFontPath, $tvsImageCount);
	$tviTextWidth = abs($tvaDimensions[2] - $tvaDimensions[0]);
	$tviTextHeight = abs($tvaDimensions[3] - $tvaDimensions[5]);

	$tviX = (imagesx($tviImage) - $tviTextWidth) / 2;
	$tviY = (imagesy($tviImage) + $tviTextHeight) / 2;


	imagettftext($tviImage, $tviFontSize, 0, $tviX+5, $tviY+10, $tvcForegroundShadow, $tvsFontPath, $tvsImageCount);
	imagettftext($tviImage, $tviFontSize, 0, $tviX, $tviY, $tvcForeground, $tvsFontPath, $tvsImageCount);

	return $tviImage;
}
function condenseCount($fvsCount) {
	$tviCount = (0+str_replace(",","",$fvsCount));
	if(!is_numeric($tviCount)) return $fvsCount;
	if($tviCount>1000000000000) return round(($tviCount/1000000000000),1).' T';
        else if($tviCount>1000000000) return round(($tviCount/1000000000),1).' B';
        else if($tviCount>1000000) return round(($tviCount/1000000),1).' M';
        else if($tviCount>1000) return round(($tviCount/1000),1).' K';

	return number_format($tviCount);
}
function remove_non_numerics($str)
{ 
    $temp       = trim($str);
    $result  = "";
    $pattern    = '/[^0-9]*/';
    $result     = preg_replace($pattern, '', $temp);

    return $result;
}
function getImage($fileName)
{
	$imgString = "";
	$handle = fopen($fileName, "rb");
	$imgString = fread($handle, filesize($fileName));
	fclose($handle);

	return $imgString;
}

function buildimage2($fvsImageTitle, $fvsImageCount) {

	$tviImage = imagecreatetruecolor(600, 400);

	$tvcBackground = imagecolorallocate($tviImage, mt_rand(50,200), mt_rand(50,200), mt_rand(50,200));
	imagefill($tviImage, 0, 0, $tvcBackground);

	$tvcForeground = imagecolorallocate($tviImage, 255, 255, 255);
/*	imagestring($tviImage, 1, 10, 10, $fvsImageTitle, $tvcForeground);
	imagestring($tviImage, 5, 50, 50, $fvsImageCount, $tvcForeground);
*/
	$width = imagesx($tviImage)/3;
	$height = imagesy($tviImage);

	$imgtmp = imagecreate($width,$height);
	$textheight = self::imagettftextalignbox($imgtmp, 25, 0, 0, 0, $tvcForeground, "/var/www/html/fonts/DroidSans.ttf", $fvsImagetitle, $width, ALIGN_CENTER);
	imagedestroy($imgtmp);
	$offsettop = ($height - $textheight)/2;
	$offsettop2 = ($height - $textheight)/3;

	if ($offsettop < 0)
		$offsettop = 0;

	self::imagettftextblur($tviImage,25,0,$width+3,$offsettop2+3,imagecolorallocate($tviImage, 0, 0, 0),"/var/www/html/fonts/DroidSans.ttf",$fvsImageTitle,5, $width, ALIGN_CENTER); 
	self::imagettftextalignbox($tviImage, 25, 0, $width, $offsettop2, $tvcForeground, "/var/www/html/fonts/DroidSans.ttf", $fvsImageTitle, $width, ALIGN_CENTER);

	self::imagettftextblur($tviImage,50,0,$width+3,$offsettop+3,imagecolorallocate($tviImage, 0, 0, 0),"/var/www/html/fonts/DroidSans.ttf",$fvsImageCount,5, $width, ALIGN_RIGHT); 
	self::imagettftextalignbox($tviImage, 50, 0, $width, $offsettop, $tvcForeground, "/var/www/html/fonts/DroidSans.ttf", $fvsImageCount, $width, ALIGN_RIGHT);


	return $tviImage;
}
function imagettftextblur(&$image,$size,$angle,$x,$y,$color,$fontfile,$text,$blur_intensity = null, $max_width,$align)
    {
	
        $blur_intensity = !is_null($blur_intensity) && is_numeric($blur_intensity) ? (int)$blur_intensity : 0;
        if ($blur_intensity > 0)
        {

            $text_shadow_image = imagecreatetruecolor(imagesx($image),imagesy($image));
            imagefill($text_shadow_image,0,0,imagecolorallocate($text_shadow_image,0x00,0x00,0x00));
            self::imagettftextalignbox($text_shadow_image,$size,$angle,$x,$y,imagecolorallocate($text_shadow_image,0xFF,0xFF,0xFF),$fontfile,$text,$max_width,$align);
$starttime = microtime(true);
            for ($blur = 1;$blur <= $blur_intensity;$blur++)
{
                //imagefilter($text_shadow_image,IMG_FILTER_GAUSSIAN_BLUR);
$gaussian = array(array(1.0, 2.0, 1.0), array(2.0, 4.0, 2.0), array(1.0, 2.0, 1.0));
imageconvolution($text_shadow_image, $gaussian, 16, 0);
}

            for ($x_offset = 0;$x_offset < imagesx($text_shadow_image);$x_offset++)
            {
                for ($y_offset = 0;$y_offset < imagesy($text_shadow_image);$y_offset++)
                {
                    $visibility = (imagecolorat($text_shadow_image,$x_offset,$y_offset) & 0xFF) / 255;
                    if ($visibility > 0)
                        imagesetpixel($image,$x_offset,$y_offset,imagecolorallocatealpha($image,($color >> 16) & 0xFF,($color >> 8) & 0xFF,$color & 0xFF,(1 - $visibility) * 127));
                }
            }
            imagedestroy($text_shadow_image);
	$endtime = microtime(true);
	$timediff = $endtime - $starttime;

        }
        else
            return self::imagettftextalignbox($image,$size,$angle,$x,$y,$color,$fontfile,$text,$max_width,$align);
    }
function imagettftextalignbox($image, $size, $angle, $left, $top, $color, $font, $text, $max_width,$align)
{
        $text_lines = explode("\n", $text); // Supports manual line breaks!
       
        $lines = array();
        $line_widths = array();
       
        $largest_line_height = 0;
       
        foreach($text_lines as $block)
        {
            $current_line = ''; // Reset current line
           
            $words = explode(' ', $block); // Split the text into an array of single words
           
            $first_word = TRUE;
           
            $last_width = 0;
           
            for($i = 0; $i < count($words); $i++)
            {
                $item = $words[$i];
                $dimensions = imagettfbbox($size, $angle, $font, $current_line . ($first_word ? '' : ' ') . $item);
                $line_width = $dimensions[2] - $dimensions[0];
                $line_height = $dimensions[1] - $dimensions[7];
               
                if($line_height > $largest_line_height) $largest_line_height = $line_height;
               
                if($line_width > $max_width && !$first_word)
                {
                    $lines[] = $current_line;
                   
                    $line_widths[] = $last_width ? $last_width : $line_width;
                   
                    /*if($i == count($words))
                    {
                        continue;
                    }*/
                   
                    $current_line = $item;
                }
                else
                {
                    $current_line .= ($first_word ? '' : ' ') . $item;
                }
               
                if($i == count($words) - 1)
                {
                    $lines[] = $current_line;
                    $dimensions = imagettfbbox($size, $angle, $font, $current_line);
                    $line_width = $dimensions[2] - $dimensions[0];
                   
                    $line_widths[] = $line_width;
                }
               
                $last_width = $line_width;
                   
                $first_word = FALSE;
            }
           
            if($current_line)
            {
                $current_line = $item;
            }
        }
       
        $i = 0;
        foreach($lines as $line)
        {
            if($align == ALIGN_CENTER)
            {
                $left_offset = ($max_width - $line_widths[$i]) / 2;
                if ($left_offset < 0 )
                {
                   $singledimensions = imagettfbbox($size, $angle, $font, $line);
                   $single_width = $singledimensions[2] - $singledimensions[0];
                   $left_offset = ($max_width - $single_width) / 2;
                }
            }
            elseif($align == ALIGN_RIGHT)
            {
                $left_offset = ($max_width - $line_widths[$i]);
                if ($left_offset < 0 )
                {
                   $singledimensions = imagettfbbox($size, $angle, $font, $line);
                   $single_width = $singledimensions[2] - $singledimensions[0];
                   $left_offset = ($max_width - $single_width);
                }
            }
            imagettftext($image, $size, $angle, $left + $left_offset, $top + $largest_line_height + ($largest_line_height * $i), $color, $font, $line);
            $i++;
        }
       
        return $largest_line_height * count($lines);
}
}
?>
