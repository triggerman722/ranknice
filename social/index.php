<?php
session_start();

$scope['title'] = "Social";

$ivsDomainName = $_SESSION['domain'];

require_once($_SERVER['DOCUMENT_ROOT']."/mainservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/social/socialservice.php");
$tvoMainService = new MainService();
$tvoSocialService = new SocialService();

$tvaSocialData = $tvoMainService->service($ivsDomainName, "socialdata", $tvoSocialService);


$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Social
		</h5>
		<p class="card-text">
			This measurement analyzes the value of <strong>$ivsDomainName</strong> based on social media data.
		</p>
	</div>
</div>

CARDDATA;

$scope['view'] = $tvsCard;

$tviRankFormatted = $tvaSocialData["rankformatted"];
$tviTwitterRankFormatted = $tvaSocialData["twitterrankformatted"];
$tviFacebookRankFormatted = $tvaSocialData["facebookrankformatted"];
$tviLinkedInRankFormatted = $tvaSocialData["linkedinrankformatted"];

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Social Rankings
		</h5>
		<pre class="card-text">Social Global Rank: $tviRankFormatted
Twitter Rank: $tviTwitterRankFormatted
Facebook Rank: $tviFacebookRankFormatted
LinkedIn Rank: $tviLinkedInRankFormatted
</pre>
	</div>
</div>
CARDDATA;

$scope['view'].= $tvsCard;

include ("../base.php");
echo $html;


?>
