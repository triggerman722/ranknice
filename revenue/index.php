<?php
session_start();

$scope['title'] = "Revenue";

$ivsDomainName = $_SESSION['domain'];

require_once("/var/www/html/mainservice.php");
require_once("/var/www/html/revenue/revenueservice.php");
$tvoMainService = new MainService();
$tvoRevenueService = new RevenueService();

$tvaRevenueData = $tvoMainService->service($ivsDomainName, "revenuedata", $tvoRevenueService);

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Revenue Rankings
		</h5>
		<p class="card-text">
			This measurement analyzes the estimated revenue of <strong>$ivsDomainName</strong>. Revenue calculations are based on the <a href="/traffic">estimated traffic</a> for <strong>$ivsDomainName</strong>.
		</p>
	</div>
</div>

CARDDATA;

$scope['view'] = $tvsCard;

$tviDaily = $tvaRevenueData["dailyformatted"];
$tviMonthly = $tvaRevenueData["monthlyformatted"];
$tviAnnual = $tvaRevenueData["annualformatted"];

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Revenue
		</h5>
		<pre class="card-text">Daily: \$$tviDaily
Monthly: \$$tviMonthly
Annual: \$$tviAnnual</pre>
	</div>
</div>
CARDDATA;

$scope['view'].= $tvsCard;

include ("../base.php");
echo $html;
?>
