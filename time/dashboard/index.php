<?php
@session_start();

$ivsDomainName = $_SESSION['domain'];

require_once("/var/www/html/mainservice.php");
require_once("/var/www/html/imageservice.php");
require_once("/var/www/html/time/timeservice.php");
$tvoMainService = new MainService();
$tvoImageService = new ImageService();
$tvoTimeService = new TimeService();

$ivoTimeData = $tvoMainService->service($ivsDomainName, "timedata", $tvoTimeService);

$tviImage = $tvoImageService->buildimage("Time Rank:", $ivoTimeData["timerankformatted"]);

header('Content-type: image/jpeg');
imagejpeg($tviImage);
imagedestroy($tviImage);
?>

