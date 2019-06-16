<?php

require_once($_SERVER['DOCUMENT_ROOT']."/mainservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/alexa/alexaservice.php");


@session_start();

class OverheadService {

	function getfrominternet($fvsDomainName) {
		error_log("Domain: ".$fvsDomainName." was obtained from internet. (valuation)");

		$tvoMainService = new MainService();
		$tvoAlexaService = new AlexaService();

		$tvaAlexaData = $tvoMainService->service($fvsDomainName, "alexadata", $tvoAlexaService);

		$tvaOverheadData = array();

		$tviGlobalRank = $tvaAlexaData["globalrank"]; 

		$tviMonthlyOverhead = round(609810000*($tviGlobalRank**-1.008));
		//$monthly_traffic_estimate = 104943144672/$tviGlobalRank;
		$tviAnnualOverhead= $tviMonthlyOverhead*12;
		$tviDailyOverhead = $tviAnnualOverhead/365;

		$tviDaily = number_format($tviDailyOverhead);
		$tviMonthly = number_format($tviMonthlyOverhead);
		$tviAnnual = number_format($tviAnnualOverhead);

		//https://stackoverflow.com/questions/30927759/how-do-i-get-the-current-cpc-bid-for-a-keyword-in-google-adwords-api
		//https://stats.wikimedia.org/v2/#/all-projects/reading/total-pageviews
		//wikipedia is 17,044,313,997, but ranked #5, so #1 would be 85,221,569,985.
		//even the idea of wikipedia getting 560,361,008 per day seems high.
		//$tviWikiMonthly = round(85221569985*($tviGlobalRank**-1.008));
		$tviWikiMonthly = round(85221569985/$tviGlobalRank);
		$tviWikiAnnual = $tviWikiMonthly*12;
		$tviWikiDaily = $tviWikiAnnual/365;

		$tviWikiDailyFormatted = number_format($tviWikiDaily);
		$tviWikiMonthlyFormatted = number_format($tviWikiMonthly);
		$tviWikiAnnualFormatted = number_format($tviWikiAnnual);

		$tvaOverheadData["dailyformatted"] = $tviDaily;
		$tvaOverheadData["monthlyformatted"] = $tviMonthly;
		$tvaOverheadData["annualformatted"] = $tviAnnual;

		return $tvaOverheadData;
	}
}
?>
