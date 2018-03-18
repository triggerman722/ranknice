<?php
session_start();

$scope['title'] = "Time";

$ivsDomainName = $_SESSION['domain'];

require_once("/var/www/html/mainservice.php");
require_once("/var/www/html/time/timeservice.php");
$tvoMainService = new MainService();
$tvoTimeService = new TimeService();

$tvaTimeData = $tvoMainService->service($ivsDomainName, "timedata", $tvoTimeService);


$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Time Ranking
		</h5>
		<p class="card-text">
			This measurement analyzes the time of the initial download of <strong>$ivsDomainName</strong>. 
		</p>
	</div>
</div>

CARDDATA;

$scope['view'] = $tvsCard;

$tvsTime = $tvaTimeData["time"];
$tvsTimeRank = $tvaTimeData["timerankformatted"];

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Time Rank
		</h5>
		<pre class="card-text">$tvsTimeRank</pre>
	</div>
</div>
CARDDATA;

$scope['view'].= $tvsCard;

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Time
		</h5>
		<pre class="card-text">$tvsTime seconds</pre>
	</div>
</div>
CARDDATA;

$scope['view'].= $tvsCard;

include ("../base.php");
echo $html;
?>
