<?php
session_start();

$scope['title'] = "Speed";

$ivsDomainName = $_SESSION['domain'];

require_once($_SERVER['DOCUMENT_ROOT']."/mainservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/speed/speedservice.php");
$tvoMainService = new MainService();
$tvoSpeedService = new SpeedService();

$tvaSpeedData = $tvoMainService->service($ivsDomainName, "speeddata", $tvoSpeedService);


$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Speed Ranking
		</h5>
		<p class="card-text">
			This measurement analyzes the speed of the initial download of <strong>$ivsDomainName</strong>. 
		</p>
	</div>
</div>

CARDDATA;

$scope['view'] = $tvsCard;

$tvsSpeed = $tvaSpeedData["speed"];
$tvsSpeedRank = $tvaSpeedData["speedrankformatted"];

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Speed Rank
		</h5>
		<pre class="card-text">$tvsSpeedRank</pre>
	</div>
</div>
CARDDATA;

$scope['view'].= $tvsCard;

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Speed
		</h5>
		<pre class="card-text">$tvsSpeed bytes per second.</pre>
	</div>
</div>
CARDDATA;

$scope['view'].= $tvsCard;

include ("../base.php");
echo $html;
?>
