<?php
@session_start();

$ivsDomainName = $_SESSION['domain'];

require_once("/var/www/html/mainservice.php");
require_once("/var/www/html/imageservice.php");
require_once("/var/www/html/toplevels/toplevelservice.php");
$tvoMainService = new MainService();
$tvoImageService = new ImageService();
$tvoToplevelService = new ToplevelService();

$ivoToplevelData = $tvoMainService->service($ivsDomainName, "topleveldata", $tvoToplevelService);

$tviImage = $tvoImageService->buildimage("Registered %:", $ivoToplevelData["registeredpercent"], "", "%");

header('Content-type: image/jpeg');
imagejpeg($tviImage);
imagedestroy($tviImage);
?>

