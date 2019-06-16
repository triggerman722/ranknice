<?php
session_start();

$scope['title'] = "Traffic";

$ivsDomainName = $_SESSION['domain'];

require_once($_SERVER['DOCUMENT_ROOT']."/mainservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/traffic/trafficservice.php");
$tvoMainService = new MainService();
$tvoTrafficService = new TrafficService();

$tvaTrafficData = $tvoMainService->service($ivsDomainName, "trafficdata", $tvoTrafficService);

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Traffic Rankings
		</h5>
		<p class="card-text">
			This measurement analyzes the estimated traffic of <strong>$ivsDomainName</strong>. It also compare this traffic to the most highly visited sites on the net.
		</p>
	</div>
</div>

CARDDATA;

$scope['view'] = $tvsCard;

$tviDaily = $tvaTrafficData["dailyformatted"];
$tviMonthly = $tvaTrafficData["monthlyformatted"];
$tviAnnual = $tvaTrafficData["annualformatted"];

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Traffic
		</h5>
		<pre class="card-text">Daily: $tviDaily
Monthly: $tviMonthly
Annual: $tviAnnual</pre>
	</div>
</div>
CARDDATA;

$scope['view'].= $tvsCard;
/*
$tviWikiDailyFormatted = $tvaTrafficData["wikidailyformatted"];
$tviWikiMonthlyFormatted = $tvaTrafficData["wikimonthlyformatted"];
$tviWikiAnnualFormatted = $tvaTrafficData["wikiannualformatted"];

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Wikipedia-based
		</h5>
		<pre class="card-text">Daily: $tviWikiDailyFormatted
Monthly: $tviWikiMonthlyFormatted
Annual: $tviWikiAnnualFormatted</pre>
	</div>
</div>
CARDDATA;

$scope['view'].= $tvsCard;
*/

include ("../base.php");
echo $html;
?>
