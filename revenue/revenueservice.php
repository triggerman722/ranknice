<?php

require_once("/var/www/html/mainservice.php");
require_once("/var/www/html/alexa/alexaservice.php");


@session_start();

class RevenueService {

	function getfrominternet($fvsDomainName) {
		error_log("Domain: ".$fvsDomainName." was obtained from internet. (traffic)");

		$tvoMainService = new MainService();
		$tvoAlexaService = new AlexaService();

		$tvaAlexaData = $tvoMainService->service($fvsDomainName, "alexadata", $tvoAlexaService);

		$tvaRevenueData = array();

		$tviGlobalRank = $tvaAlexaData["globalrank"]; 
		$tviMonthly = round(104943144672*($tviGlobalRank**-1.008));
		$tviAnnual= $tviMonthly*12;
		$tviDaily = $tviAnnual/365;

		$tviDailyRevenue = $tviDaily / 1000 * 3;
		$tviMonthlyRevenue = $tviMonthly / 1000 * 3;
		$tviAnnualRevenue = $tviAnnual / 1000 * 3;

		$tviDailyFormatted = number_format($tviDailyRevenue, 2);
		$tviMonthlyFormatted = number_format($tviMonthlyRevenue, 2);
		$tviAnnualFormatted = number_format($tviAnnualRevenue, 2);

		$tvaRevenueData["dailyformatted"] = $tviDailyFormatted;
		$tvaRevenueData["monthlyformatted"] = $tviMonthlyFormatted;
		$tvaRevenueData["annualformatted"] = $tviAnnualFormatted;
		$tvaRevenueData["annualrevenue"] = $tviAnnualRevenue;

		return $tvaRevenueData;
	}
}
?>
