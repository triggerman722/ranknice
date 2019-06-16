<?php
@session_start();

$ivsDomainName = $_SESSION['domain'];

require_once($_SERVER['DOCUMENT_ROOT']."/mainservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/imageservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/speed/speedservice.php");
$tvoMainService = new MainService();
$tvoImageService = new ImageService();
$tvoSpeedService = new SpeedService();

$ivoSpeedData = $tvoMainService->service($ivsDomainName, "speeddata", $tvoSpeedService);

$tviImage = $tvoImageService->buildimage("Speed Rank:", $ivoSpeedData["speedrankformatted"]);

header('Content-type: image/jpeg');
imagejpeg($tviImage);
imagedestroy($tviImage);
?>

