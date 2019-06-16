<?php
@session_start();

$ivsDomainName = $_SESSION['domain'];

require_once($_SERVER['DOCUMENT_ROOT']."/mainservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/imageservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/revenue/revenueservice.php");
$tvoMainService = new MainService();
$tvoImageService = new ImageService();
$tvoRevenueService = new RevenueService();

$ivoRevenueData = $tvoMainService->service($ivsDomainName, "revenuedata", $tvoRevenueService);

$tviImage = $tvoImageService->buildimage("Monthly Revenue:", $ivoRevenueData["monthlyformatted"], "$");

header('Content-type: image/jpeg');
imagejpeg($tviImage);
imagedestroy($tviImage);
?>

