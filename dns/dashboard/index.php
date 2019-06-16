<?php
@session_start();

$ivsDomainName = $_SESSION['domain'];

require_once($_SERVER['DOCUMENT_ROOT']."/mainservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/imageservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/dns/dnsservice.php");
$tvoMainService = new MainService();
$tvoImageService = new ImageService();
$tvoDNSService = new DNSService();

$ivoDNSData = $tvoMainService->service($ivsDomainName, "dnsdata", $tvoDNSService);

$tviImage = $tvoImageService->buildimage("DNS Rank:", $ivoDNSData["dnsagerankformatted"]);

header('Content-type: image/jpeg');
imagejpeg($tviImage);
imagedestroy($tviImage);
?>

