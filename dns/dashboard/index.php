<?php
@session_start();

$ivsDomainName = $_SESSION['domain'];

require_once("/var/www/html/mainservice.php");
require_once("/var/www/html/imageservice.php");
require_once("/var/www/html/dns/dnsservice.php");
$tvoMainService = new MainService();
$tvoImageService = new ImageService();
$tvoDNSService = new DNSService();

$ivoDNSData = $tvoMainService->service($ivsDomainName, "dnsdata", $tvoDNSService);

$tviImage = $tvoImageService->buildimage("DNS Rank:", $ivoDNSData["dnsagerankformatted"]);

header('Content-type: image/jpeg');
imagejpeg($tviImage);
imagedestroy($tviImage);
?>

