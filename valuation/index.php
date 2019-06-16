<?php
session_start();

$scope['title'] = "Valuation";

$ivsDomainName = $_SESSION['domain'];

require_once($_SERVER['DOCUMENT_ROOT']."/mainservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/valuation/valuationservice.php");
$tvoMainService = new MainService();
$tvoValuationService = new ValuationService();

$tvaValuationData = $tvoMainService->service($ivsDomainName, "valuationdata", $tvoValuationService);

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Valuation
		</h5>
		<p class="card-text">
			This measurement analyzes the estimated value of <strong>$ivsDomainName</strong>.
		</p>
	</div>
</div>

CARDDATA;

$scope['view'] = $tvsCard;

$tviRevenueValuationFormatted = $tvaValuationData["revenuevaluationformatted"];

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Revenue Times Value Estimate
		</h5>
		<pre class="card-text">\$$tviRevenueValuationFormatted</pre>
	</div>
</div>
CARDDATA;

$scope['view'].= $tvsCard;
$tviValuationFormatted = $tvaValuationData["valuationformatted"];

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Linear Market Cap Estimate
		</h5>
		<pre class="card-text">\$$tviValuationFormatted</pre>
	</div>
</div>
CARDDATA;

$scope['view'].= $tvsCard;

$tviRankvalueEstimateFormatted = $tvaValuationData["rankvalueestimateformatted"];

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Rank Value Estimate
		</h5>
		<pre class="card-text">\$$tviRankvalueEstimateFormatted</pre>
	</div>
</div>
CARDDATA;

$scope['view'].= $tvsCard;

$tviDomainvalueEstimateFormatted = $tvaValuationData["domainvalueestimateformatted"];

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Domain Value Estimate
		</h5>
		<pre class="card-text">\$$tviDomainvalueEstimateFormatted</pre>
	</div>
</div>
CARDDATA;

$scope['view'].= $tvsCard;

include ("../base.php");
echo $html;
?>
