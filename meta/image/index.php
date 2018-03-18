<?php
//session_start();
$ivsDomainName = $_REQUEST['domain'];
//print $ivsDomainName;

$tvuFavicon = "http://".$ivsDomainName."/favicon.ico";
$tvsFavicon = file_get_contents("$tvuFavicon");
$tvsTemp = tempnam(sys_get_temp_dir(), 'Tux');
file_put_contents($tvsTemp, $tvsFavicon);
$tvsIconpng = $tvsTemp.".png";
rename($tvsTemp, $tvsTemp.= '.ico');
chmod("$tvsTemp", 0644);
//print $tvsIcon;
$tvsConvert = "convert \"$tvsTemp\" -thumbnail 16x16 -alpha on -background none -flatten \"$tvsIconpng\"";
exec($tvsConvert);
//$tviImage = imagecreatefromstring($tvsIcon);

header('Content-type: image/png');
readfile($tvsIconpng);

unlink($tvsTemp);
unlink($tvsIconpng);

?>
