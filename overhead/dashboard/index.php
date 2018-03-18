<?php
@session_start();

$ivsDomainName = $_SESSION['domain'];

require_once("/var/www/html/mainservice.php");
require_once("/var/www/html/imageservice.php");
require_once("/var/www/html/overhead/overheadservice.php");
$tvoMainService = new MainService();
$tvoImageService = new ImageService();
$tvoOverheadService = new OverheadService();

$ivoOverheadData = $tvoMainService->service($ivsDomainName, "overheaddata", $tvoOverheadService);

$tviImage = $tvoImageService->buildimage("Monthly Overhead:", $ivoOverheadData["monthlyformatted"], "$");

header('Content-type: image/jpeg');
imagejpeg($tviImage);
imagedestroy($tviImage);
?>

