<?php
session_start();

$ivsDomainName = $_SESSION['domain'];

require_once("/var/www/html/mainservice.php");
require_once("/var/www/html/headers/headerservice.php");
$tvoMainService = new MainService();
$tvoHeaderService = new HeaderService();

$tvaHeaderData = $tvoMainService->service($ivsDomainName, "headerdata", $tvoHeaderService);


$scope['title'] = "Header Ranking for $ivsDomainName";

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Header Rankings
		</h5>
		<p class="card-text">
			This measurement analyzes the headers of <strong>$ivsDomainName</strong>. Here, we look at the size of the headers, their impact on performance and how they relate to the headers of top ranking websites.
		</p>
	</div>
</div>

CARDDATA;

$scope['view'] = $tvsCard;

$tvsHeader = $tvaHeaderData["rawheader"];
$tviHeaderLength = $tvaHeaderData["headersize"];
$tviHeaderSizeRankFormatted = $tvaHeaderData["headersizerankformatted"];

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Header Ranking
		</h5>
		<pre class="card-text">Size Rank: $tviHeaderSizeRankFormatted
Size: $tviHeaderLength</pre>
	</div>
</div>
CARDDATA;

$scope['view'].= $tvsCard;

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Raw Header Data
		</h5>
		<pre class="card-text">$tvsHeader</pre>
	</div>
</div>
CARDDATA;

$scope['view'].= $tvsCard;

include ("../base.php");
echo $html;
?>
