<?php
@session_start();

$ivsDomainName = $_SESSION['domain'];

require_once("/var/www/html/mainservice.php");
require_once("/var/www/html/imageservice.php");
require_once("/var/www/html/size/sizeservice.php");
$tvoMainService = new MainService();
$tvoImageService = new ImageService();
$tvoSizeService = new SizeService();

$ivoSizeData = $tvoMainService->service($ivsDomainName, "sizedata", $tvoSizeService);

$tviImage = $tvoImageService->buildimage("Size Rank:", $ivoSizeData["sizerankformatted"]);

header('Content-type: image/jpeg');
imagejpeg($tviImage);
imagedestroy($tviImage);
?>

