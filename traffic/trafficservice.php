<?php

require_once($_SERVER['DOCUMENT_ROOT']."/mainservice.php");
require_once($_SERVER['DOCUMENT_ROOT']."/alexa/alexaservice.php");


@session_start();

class TrafficService {

	function getfrominternet($fvsDomainName) {
		error_log("Domain: ".$fvsDomainName." was obtained from internet. (traffic)");

		$tvoMainService = new MainService();
		$tvoAlexaService = new AlexaService();

		$tvaAlexaData = $tvoMainService->service($fvsDomainName, "alexadata", $tvoAlexaService);

		$tvaTrafficData = array();

		$tviGlobalRank = $tvaAlexaData["globalrank"]; 
		//traffic estimate
		$tviMonthly = round(104943144672*($tviGlobalRank**-1.008));
		//$monthly_traffic_estimate = 104943144672/$tviGlobalRank;
		$tviAnnual= $tviMonthly*12;
		$tviDaily = $tviAnnual/365;

		$tviDailyFormatted = number_format($tviDaily);
		$tviMonthlyFormatted = number_format($tviMonthly);
		$tviAnnualFormatted = number_format($tviAnnual);

		$tvaTrafficData["dailyformatted"] = $tviDailyFormatted;
		$tvaTrafficData["monthlyformatted"] = $tviMonthlyFormatted;
		$tvaTrafficData["annualformatted"] = $tviAnnualFormatted;

//7360334422
//17044313997
//85221569985
//36801672110

//		$tviWikiMonthly = round(85221569985/$tviGlobalRank);
		$tviWikiMonthly = round(36801672110/$tviGlobalRank);
		$tviWikiAnnual = $tviWikiMonthly*12;
		$tviWikiDaily = $tviWikiAnnual/365;

		$tviWikiDailyFormatted = number_format($tviWikiDaily);
		$tviWikiMonthlyFormatted = number_format($tviWikiMonthly);
		$tviWikiAnnualFormatted = number_format($tviWikiAnnual);

//		$tvaTrafficData["wikidailyformatted"] = $tviWikiDailyFormatted;
//		$tvaTrafficData["wikimonthlyformatted"] = $tviWikiMonthlyFormatted;
//		$tvaTrafficData["wikiannualformatted"] = $tviWikiAnnualFormatted;

		$tvaTrafficData["dailyformatted"] = $tviWikiDailyFormatted;
		$tvaTrafficData["monthlyformatted"] = $tviWikiMonthlyFormatted;
		$tvaTrafficData["annualformatted"] = $tviWikiAnnualFormatted;

		return $tvaTrafficData;
	}
}
?>
