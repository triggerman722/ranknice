<?php
@session_start();

$ivsDomainName = $_SESSION['domain'];

require_once("/var/www/html/mainservice.php");
require_once("/var/www/html/imageservice.php");
require_once("/var/www/html/revenue/revenueservice.php");
$tvoMainService = new MainService();
$tvoImageService = new ImageService();
$tvoRevenueService = new RevenueService();

$ivoRevenueData = $tvoMainService->service($ivsDomainName, "revenuedata", $tvoRevenueService);

$tviImage = $tvoImageService->buildimage("Monthly Revenue:", $ivoRevenueData["monthlyformatted"], "$");

header('Content-type: image/jpeg');
imagejpeg($tviImage);
imagedestroy($tviImage);
?>

