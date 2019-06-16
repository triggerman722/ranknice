<?php
session_start();

$scope['title'] = "Size";

$ivsDomainName = $_SESSION['domain'];

require_once($_SERVER['DOCUMENT_ROOT']."/mainservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/size/sizeservice.php");
$tvoMainService = new MainService();
$tvoSizeService = new SizeService();

$tvaSizeData = $tvoMainService->service($ivsDomainName, "sizedata", $tvoSizeService);


$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Size Ranking
		</h5>
		<p class="card-text">
			This measurement analyzes the size of the initial download of <strong>$ivsDomainName</strong>. 
		</p>
	</div>
</div>

CARDDATA;

$scope['view'] = $tvsCard;

$tvsSize = $tvaSizeData["size"];
$tvsSizeRank = $tvaSizeData["sizerankformatted"];

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Size Rank
		</h5>
		<pre class="card-text">$tvsSizeRank</pre>
	</div>
</div>
CARDDATA;

$scope['view'].= $tvsCard;

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Total Size
		</h5>
		<pre class="card-text">$tvsSize bytes.</pre>
	</div>
</div>
CARDDATA;

$scope['view'].= $tvsCard;

include ("../base.php");
echo $html;
?>
