<?php
@session_start();

class SizeService {

	function getfrominternet($fvsDomainName) {
		error_log("Domain: ".$fvsDomainName." was obtained from internet. (size)");

		$tvaSizeData = array();

		$ivsSize = $_SESSION['downloadsize'];

		$tviBest = 8012; //timhortons
		$tviWorst = 459677; //youtube
		$tviTotalSites = 1000000;

                $tviSizeAdjusted = max(($ivsSize-$tviBest), 0);

                $tviStep = $tviWorst/$tviBest;
                $tviSizeRank = ceil($tviSizeAdjusted/$tviStep)+1;
                $tviSizeRankFormatted = number_format($tviSizeRank);

		$tvaSizeData["size"] = $ivsSize;
		$tvaSizeData["sizerankformatted"] = $tviSizeRankFormatted;

		return $tvaSizeData;
	}
}
?>
