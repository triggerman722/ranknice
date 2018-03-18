<?php
@session_start();

$ivsDomainName = $_SESSION['domain'];

require_once("/var/www/html/mainservice.php");
require_once("/var/www/html/imageservice.php");
require_once("/var/www/html/headers/headerservice.php");
$tvoMainService = new MainService();
$tvoImageService = new ImageService();
$tvoHeaderService = new HeaderService();

$ivoHeaderData = $tvoMainService->service($ivsDomainName, "headerdata", $tvoHeaderService);

$tviImage = $tvoImageService->buildimage("Header Rank:", $ivoHeaderData["headersizerankformatted"]);

header('Content-type: image/jpeg');
imagejpeg($tviImage);
imagedestroy($tviImage);
?>

