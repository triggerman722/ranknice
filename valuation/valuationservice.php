<?php

require_once("/var/www/html/mainservice.php");
require_once("/var/www/html/alexa/alexaservice.php");
require_once("/var/www/html/revenue/revenueservice.php");


@session_start();

class ValuationService {

	function getfrominternet($fvsDomainName) {
		error_log("Domain: ".$fvsDomainName." was obtained from internet. (valuation)");

		$tvoMainService = new MainService();
		$tvoAlexaService = new AlexaService();

		$tvaAlexaData = $tvoMainService->service($fvsDomainName, "alexadata", $tvoAlexaService);

		$tvaValuationData = array();

		$tviGlobalRank = $tvaAlexaData["globalrank"]; 

		$tvoRevenueService = new RevenueService();

		$tvaRevenueData = $tvoMainService->service($fvsDomainName, "revenuedata", $tvoRevenueService);

		$tvfTimesRevenueMultiplier = 2.44;
		$tviRevenueValuation = $tvaRevenueData["annualrevenue"] * $tvfTimesRevenueMultiplier;
		$tviRevenueValuationFormatted = number_format($tviRevenueValuation,2);
		$tvaValuationData["revenuevaluationformatted"] = $tviRevenueValuationFormatted;


		$tviFacebookMarketcap = 515230000000;
		$tviValuation = $tviFacebookMarketcap/ $tviGlobalRank;
		$tviValuationFormatted = number_format($tviValuation,2);
		$tvaValuationData["valuationformatted"] = $tviValuationFormatted;

		$tviRankvalueEstimate = round(515230000000*($tviGlobalRank**-1.008));
		$tviRankvalueEstimateFormatted = number_format($tviRankvalueEstimate,2);
		$tvaValuationData["rankvalueestimateformatted"] = $tviRankvalueEstimateFormatted;

		//domain name value estimate: https://en.wikipedia.org/wiki/List_of_most_expensive_domain_names
		$tviDomainvalueEstimate = round(35600000*($tviGlobalRank**-1.008));
		$tviDomainvalueEstimateFormatted = number_format($tviDomainvalueEstimate, 2);
		$tvaValuationData["domainvalueestimateformatted"] = $tviDomainvalueEstimateFormatted;

		return $tvaValuationData;
	}
}
?>
