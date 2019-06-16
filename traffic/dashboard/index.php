<?php
@session_start();

$ivsDomainName = $_SESSION['domain'];

require_once($_SERVER['DOCUMENT_ROOT']."/mainservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/imageservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/traffic/trafficservice.php");
$tvoMainService = new MainService();
$tvoImageService = new ImageService();
$tvoTrafficService = new TrafficService();

$ivoTrafficData = $tvoMainService->service($ivsDomainName, "trafficdata", $tvoTrafficService);

$tviImage = $tvoImageService->buildimage("Monthly Traffic:", $ivoTrafficData["monthlyformatted"]);

header('Content-type: image/jpeg');
imagejpeg($tviImage);
imagedestroy($tviImage);
?>

