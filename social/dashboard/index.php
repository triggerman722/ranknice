<?php
@session_start();

$ivsDomainName = $_SESSION['domain'];

require_once("/var/www/html/mainservice.php");
require_once("/var/www/html/imageservice.php");
require_once("/var/www/html/social/socialservice.php");
$tvoMainService = new MainService();
$tvoImageService = new ImageService();
$tvoSocialService = new SocialService();

$ivoSocialData = $tvoMainService->service($ivsDomainName, "socialdata", $tvoSocialService);

$tviImage = $tvoImageService->buildimage("Social Global Rank:", $ivoSocialData["rankformatted"]);

header('Content-type: image/jpeg');
imagejpeg($tviImage);
imagedestroy($tviImage);
?>

