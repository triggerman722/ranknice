<?php
@session_start();

$ivsDomainName = $_SESSION['domain'];

require_once($_SERVER['DOCUMENT_ROOT']."/mainservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/imageservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/headers/headerservice.php");
$tvoMainService = new MainService();
$tvoImageService = new ImageService();
$tvoHeaderService = new HeaderService();

$ivoHeaderData = $tvoMainService->service($ivsDomainName, "headerdata", $tvoHeaderService);

$tviImage = $tvoImageService->buildimage("Header Rank:", $ivoHeaderData["headersizerankformatted"]);

header('Content-type: image/jpeg');
imagejpeg($tviImage);
imagedestroy($tviImage);
?>

