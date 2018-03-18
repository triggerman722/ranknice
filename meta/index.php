<?php
session_start();

$scope['title'] = "Meta Content Data";

$ivsDomainName = $_SESSION['domain'];
$ivsTitle = $_SESSION['title'];

require_once("/var/www/html/mainservice.php");
require_once("/var/www/html/meta/metaservice.php");
$tvoMainService = new MainService();
$tvoMetaService = new MetaService();

$tvaMetaData = $tvoMainService->service($ivsDomainName, "metadata", $tvoMetaService);

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
        <div class="card-body">
                <h5 class="card-title">
                        Meta Content Summary
                </h5>
                <p class="card-text">
                        This area returns the values provided by <strong>$ivsDomainName</strong> in the <code>meta</code> section of their main page.
                </p>
        </div>
</div>

CARDDATA;

$scope['view'] = $tvsCard;

$tvsKeywords = $tvaMetaData["keywordsformatted"];
$tvsDescription = $tvaMetaData["description"];

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Meta Tags
		</h5>
		<p class="card-text">
<h5>Title:</h5>$ivsTitle<br>
<h5>Icon:</h5><img src="/meta/image/?domain=$ivsDomainName" />
<h5>Keywords:</h5><p>$tvsKeywords</p>
<h5>Description:</h5><pre>$tvsDescription</pre>
		</p>
	</div>
</div>

CARDDATA;

$scope['view'].= $tvsCard;

include ("../base.php");
echo $html;
?>
