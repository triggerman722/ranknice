<?php
@session_start();

$ivsDomainName = $_SESSION['domain'];

require_once($_SERVER['DOCUMENT_ROOT']."/mainservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/imageservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/time/timeservice.php");
$tvoMainService = new MainService();
$tvoImageService = new ImageService();
$tvoTimeService = new TimeService();

$ivoTimeData = $tvoMainService->service($ivsDomainName, "timedata", $tvoTimeService);

$tviImage = $tvoImageService->buildimage("Time Rank:", $ivoTimeData["timerankformatted"]);

header('Content-type: image/jpeg');
imagejpeg($tviImage);
imagedestroy($tviImage);
?>

