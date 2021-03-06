<?php
@session_start();

$ivsDomainName = $_SESSION['domain'];

require_once($_SERVER['DOCUMENT_ROOT']."/mainservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/imageservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/valuation/valuationservice.php");
$tvoMainService = new MainService();
$tvoImageService = new ImageService();
$tvoValuationService = new ValuationService();

$ivoValuationData = $tvoMainService->service($ivsDomainName, "valuationdata", $tvoValuationService);

//$tviImage = $tvoImageService->buildimage("Valuation:", $ivoValuationData["valuationformatted"], "$");
$tviImage = $tvoImageService->buildimage("Valuation:", $ivoValuationData["revenuevaluationformatted"], "$");

header('Content-type: image/jpeg');
imagejpeg($tviImage);
imagedestroy($tviImage);
?>

