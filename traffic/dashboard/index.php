<?php
@session_start();

$ivsDomainName = $_SESSION['domain'];

require_once("/var/www/html/mainservice.php");
require_once("/var/www/html/imageservice.php");
require_once("/var/www/html/traffic/trafficservice.php");
$tvoMainService = new MainService();
$tvoImageService = new ImageService();
$tvoTrafficService = new TrafficService();

$ivoTrafficData = $tvoMainService->service($ivsDomainName, "trafficdata", $tvoTrafficService);

$tviImage = $tvoImageService->buildimage("Monthly Traffic:", $ivoTrafficData["monthlyformatted"]);

header('Content-type: image/jpeg');
imagejpeg($tviImage);
imagedestroy($tviImage);
?>

