<?php
@session_start();

class TimeService {

	function getfrominternet($fvsDomainName) {
		error_log("Domain: ".$fvsDomainName." was obtained from internet. (time)");

		$tvaTimeData = array();

		$ivsTime = $_SESSION['totaltime'];

		$tviBest = 15;
		$tviWorst = 15000;
		$tviTotalSites = 1000000;

                $tviTimeAdjusted = max(($ivsTime-$tviBest), 0);

                $tviStep = $tviWorst/$tviBest;
                $tviTimeRank = ceil($tviTimeAdjusted*$tviStep)+1;
                $tviTimeRankFormatted = number_format($tviTimeRank);

		$tvaTimeData["time"] = $ivsTime;
		$tvaTimeData["timerankformatted"] = $tviTimeRankFormatted;

		return $tvaTimeData;
	}
}
?>
