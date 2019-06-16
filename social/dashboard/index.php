<?php
@session_start();

$ivsDomainName = $_SESSION['domain'];

require_once($_SERVER['DOCUMENT_ROOT']."/mainservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/imageservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/social/socialservice.php");
$tvoMainService = new MainService();
$tvoImageService = new ImageService();
$tvoSocialService = new SocialService();

$ivoSocialData = $tvoMainService->service($ivsDomainName, "socialdata", $tvoSocialService);

$tviImage = $tvoImageService->buildimage("Social Global Rank:", $ivoSocialData["rankformatted"]);

header('Content-type: image/jpeg');
imagejpeg($tviImage);
imagedestroy($tviImage);
?>

