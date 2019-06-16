<?php
@session_start();

$scope['title'] = "Alexa Data";

$ivsDomainName = $_SESSION['domain'];

require_once($_SERVER['DOCUMENT_ROOT']."/mainservice.php");
require_once("./alexaservice.php");
$tvoMainService = new MainService();
$tvoAlexaService = new AlexaService();

$ivoAlexaData = $tvoMainService->service($ivsDomainName, "alexadata", $tvoAlexaService);

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
        <div class="card-body">
                <h5 class="card-title">
                        Alexa Rankings
                </h5>
                <p class="card-text">
                        This measurement returns the rankings from <a href="https://www.alexa.com">Alexa.com</a> for the domain <strong>$ivsDomainName</strong>. The values returned are used in subsequent rankings, including <a href="/revenue">Revenue</a>, <a href="/traffic">Traffic</a> and <a href="/overhead">Overhead</a>.
                </p>
        </div>
</div>

CARDDATA;

$scope['view'] = $tvsCard;

$tvuAlexaImage = "http://traffic.alexa.com/graph?u=".$ivsDomainName;
$tvuAlexaTrafficImage = "http://traffic.alexa.com/graph?o=f&c=1&y=q&u=".$ivsDomainName;

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Alexa Global Rankings
		</h5>
		<p class="card-text">
			<img class="img-fluid" alt="Responsive image" src = "$tvuAlexaImage" />
		</p>
	</div>
</div>
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Alexa Traffic Rankings
		</h5>
		<p class="card-text">
			<img class="img-fluid" alt="Responsive image" src = "$tvuAlexaTrafficImage" />
		</p>
	</div>
</div>

CARDDATA;

$scope['view'].= $tvsCard;

$tviGlobalRank = $ivoAlexaData["globalrankformatted"];
// country rank
$tvsCountryCode = $ivoAlexaData["countrycode"];
$tvsCountryName = $ivoAlexaData["countryname"];
$tviCountryRankFormatted = $ivoAlexaData["countryrankformatted"];
$tviReachRankFormatted = $ivoAlexaData["reachrankformatted"];
$tviRankDeltaFormatted = $ivoAlexaData["rankdeltaformatted"];

$tvsCard = <<< CARDDATA
<div class="card mb-3 box-shadow">
	<div class="card-body">
		<h5 class="card-title">
			Alexa Ranking Data
		</h5>
		<pre class="card-text">
Alexa Global Rank: $tviGlobalRank
Alexa Delta: $tviRankDeltaFormatted
Alexa Reach Rank: $tviReachRankFormatted
Alexa Country: $tvsCountryName
Alexa Rank in Country: $tviCountryRankFormatted
</pre>
	</div>
</div>
CARDDATA;

$scope['view'].= $tvsCard;

include ("../base.php");
echo $html;
?>
