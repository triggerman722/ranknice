<?php
//should be valid to either pull content from the session, a cache (TODO), or a call to the service (which will be like a hard refresh).
//Session: the user has already been to either this page, or its main page
//Cache: this user has not been to the page, but another user has within the last month
//Service: this is the first call, or the first call in a month.

@session_start();

$ivsDomainName = $_SESSION['domain'];

require_once($_SERVER['DOCUMENT_ROOT']."/mainservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/imageservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/alexa/alexaservice.php");
$tvoMainService = new MainService();
$tvoImageService = new ImageService();
$tvoAlexaService = new AlexaService();

$ivoAlexaData = $tvoMainService->service($ivsDomainName, "alexadata", $tvoAlexaService);
$tviImage = $tvoImageService->buildimage("Alexa Global Rank", $ivoAlexaData["globalrankformatted"]);

header('Content-type: image/jpeg');
imagejpeg($tviImage);
imagedestroy($tviImage);
?>

