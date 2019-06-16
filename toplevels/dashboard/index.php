<?php
@session_start();

$ivsDomainName = $_SESSION['domain'];

require_once($_SERVER['DOCUMENT_ROOT']."/mainservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/imageservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/toplevels/toplevelservice.php");
$tvoMainService = new MainService();
$tvoImageService = new ImageService();
$tvoToplevelService = new ToplevelService();

$ivoToplevelData = $tvoMainService->service($ivsDomainName, "topleveldata", $tvoToplevelService);

$tviImage = $tvoImageService->buildimage("Registered %:", $ivoToplevelData["registeredpercent"], "", "%");

header('Content-type: image/jpeg');
imagejpeg($tviImage);
imagedestroy($tviImage);
?>

