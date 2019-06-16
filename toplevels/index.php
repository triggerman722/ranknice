<?php
session_start();

$scope['title'] = "Top Levels";

$ivsDomainName = $_SESSION['domain'];

require_once($_SERVER['DOCUMENT_ROOT']."/mainservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/toplevels/toplevelservice.php");
$tvoMainService = new MainService();
$tvoToplevelService = new ToplevelService();

$tvaToplevelData = $tvoMainService->service($ivsDomainName, "topleveldata", $tvoToplevelService);

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Top Levels
		</h5>
		<p class="card-text">
			This measurement analyzes the top level domains (TLDs) registered to the brand of <strong>$ivsDomainName</strong>.
		</p>
	</div>
</div>

CARDDATA;

$scope['view'] = $tvsCard;

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
        <div class="card-body">
                <h5 class="card-title">
                        Registration for the Top 10 TLDs
                </h5>
                <pre class="card-text"><ol>
CARDDATA;

$tviRegisteredPercent = $tvaToplevelData["registeredpercent"];
$tvsCard.= $tvaToplevelData["cardtext"];
$tvsCard.="</ol>Registration Percent: $tviRegisteredPercent%</pre></div></div>";
$scope['view'].= $tvsCard;

include ("../base.php");
echo $html;
?>
