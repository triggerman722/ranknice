<?php
session_start();

$scope['title'] = "DNS";

$ivsDomainName = $_SESSION['domain'];

require_once($_SERVER['DOCUMENT_ROOT']."/mainservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/dns/dnsservice.php");
$tvoMainService = new MainService();
$tvoDNSService = new DNSService();

$tvaDNSData = $tvoMainService->service($ivsDomainName, "dnsdata", $tvoDNSService);


$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			DNS Rankings
		</h5>
		<p class="card-text">
			This measurement analyzes the DNS records of <strong>$ivsDomainName</strong>. 
		</p>
	</div>
</div>

CARDDATA;

$scope['view'] = $tvsCard;

$tvsDNS = $tvaDNSData["dnsagerankformatted"];

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			DNS Age Rank
		</h5>
		<pre class="card-text">$tvsDNS</pre>
	</div>
</div>
CARDDATA;

$scope['view'].= $tvsCard;

$tvsDNS = $tvaDNSData["rawtext"];

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Raw DNS Data
		</h5>
		<pre class="card-text">$tvsDNS</pre>
	</div>
</div>
CARDDATA;

$scope['view'].= $tvsCard;

$tvaDNS = $tvaDNSData["dnsrecordarray"];

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Raw DNS Data
		</h5>
		<pre class="card-text">$tvaDNS</pre>
	</div>
</div>
CARDDATA;

$scope['view'].= $tvsCard;

include ("../base.php");
echo $html;
?>
