<?php
@session_start();

$ivsDomainName = $_SESSION['domain'];

require_once("/var/www/html/mainservice.php");
require_once("/var/www/html/imageservice.php");
require_once("/var/www/html/speed/speedservice.php");
$tvoMainService = new MainService();
$tvoImageService = new ImageService();
$tvoSpeedService = new SpeedService();

$ivoSpeedData = $tvoMainService->service($ivsDomainName, "speeddata", $tvoSpeedService);

$tviImage = $tvoImageService->buildimage("Speed Rank:", $ivoSpeedData["speedrankformatted"]);

header('Content-type: image/jpeg');
imagejpeg($tviImage);
imagedestroy($tviImage);
?>

