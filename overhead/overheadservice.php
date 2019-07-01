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

		$tviMonthly = round(609810000*($tviGlobalRank**-1.008));
		//$monthly_traffic_estimate = 104943144672/$tviGlobalRank;
		$tviAnnual= $tviMonthly*12;
		$tviDaily = $tviAnnual/365;

                $tviDailyOverhead = $tviDaily / 1000 * 3;
                $tviMonthlyOverhead = $tviMonthly / 1000 * 3;
                $tviAnnualOverhead = $tviAnnual / 1000 * 3;

		$tviDailyFormatted = number_format($tviDailyOverhead, 2);
		$tviMonthlyFormatted = number_format($tviMonthlyOverhead, 2);
		$tviAnnualFormatted = number_format($tviAnnualOverhead, 2);

		$tvaOverheadData["dailyformatted"] = $tviDailyFormatted;
		$tvaOverheadData["monthlyformatted"] = $tviMonthlyFormatted;
		$tvaOverheadData["annualformatted"] = $tviAnnualFormatted;

		return $tvaOverheadData;
	}
}
?>
