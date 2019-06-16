<?php
@session_start();

$ivsDomainName = $_SESSION['domain'];

require_once($_SERVER['DOCUMENT_ROOT']."/mainservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/imageservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/overhead/overheadservice.php");
$tvoMainService = new MainService();
$tvoImageService = new ImageService();
$tvoOverheadService = new OverheadService();

$ivoOverheadData = $tvoMainService->service($ivsDomainName, "overheaddata", $tvoOverheadService);

$tviImage = $tvoImageService->buildimage("Monthly Overhead:", $ivoOverheadData["monthlyformatted"], "$");

header('Content-type: image/jpeg');
imagejpeg($tviImage);
imagedestroy($tviImage);
?>

