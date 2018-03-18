<?php
@session_start();

class SpeedService {

	function getfrominternet($fvsDomainName) {
		error_log("Domain: ".$fvsDomainName." was obtained from internet. (speed)");

		$tvaSpeedData = array();

		$ivsSpeed = $_SESSION['downloadspeed'];

		$tviBest = 15;
		$tviWorst = 15000;
		$tviTotalSites = 1000000;

                $tviSpeedAdjusted = max(($ivsSpeed-$tviBest), 0);

                $tviStep = $tviWorst/$tviBest;
                $tviSpeedRank = ceil($tviSpeedAdjusted*$tviStep)+1;
                $tviSpeedRankFormatted = number_format($tviSpeedRank);

		$tvaSpeedData["speed"] = $ivsSpeed;
		$tvaSpeedData["speedrankformatted"] = $tviSpeedRankFormatted;

		return $tvaSpeedData;
	}
}
?>
