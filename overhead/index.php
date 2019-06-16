<?php
session_start();

$scope['title'] = "Overhead";

$ivsDomainName = $_SESSION['domain'];

require_once($_SERVER['DOCUMENT_ROOT']."/mainservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/overhead/overheadservice.php");
$tvoMainService = new MainService();
$tvoOverheadService = new OverheadService();

$tvaOverheadData = $tvoMainService->service($ivsDomainName, "overheaddata", $tvoOverheadService);

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Overhead Rankings
		</h5>
		<p class="card-text">
			This measurement analyzes the estimated overhead costs of maintaining <strong>$ivsDomainName</strong>. It also compare this cost to the most highly visited sites on the net.
		</p>
	</div>
</div>

CARDDATA;

$scope['view'] = $tvsCard;

$tviDaily = $tvaOverheadData["dailyformatted"];
$tviMonthly = $tvaOverheadData["monthlyformatted"];
$tviAnnual = $tvaOverheadData["annualformatted"];

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Overhead Costs:
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
