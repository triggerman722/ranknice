<?php
@session_start();

class HeaderService {

	function getfrominternet($fvsDomainName) {
		error_log("Domain: ".$fvsDomainName." was obtained from internet. (header)");

		$tvaHeaderData = array();

		$ivsHeader = $_SESSION['header'];

		$tviHeaderLength = strlen($ivsHeader);

		$tviBestHeader = 163; //as seen via timhortons.com
		$tviWorstHeader = 5408; //as seen via  netflix.com
		$tviHeaderLengthAdjusted = max(($tviHeaderLength-$tviBestHeader), 0);
		$tviTotalSites = 1000000;

		$tviHeaderStep = $tviWorstHeader/$tviBestHeader;
		$tviHeaderSizeRank = ceil($tviHeaderLengthAdjusted*$tviHeaderStep)+1;
		$tviHeaderSizeRankFormatted = number_format($tviHeaderSizeRank);
		//1,341,773,025 total websites

		$tviNumberRedirects = 4; //rank on redirects (more is worse), but 1 is better than 0, assuming that 1 goes to ssl
		$tviNumberCookies = 0; //cookies should (must?) be 0 for this. A cookie should not be set for a random curl request.
		$tviNumberXHeaders = 0; //X-Headers are custom headers. They are implicitly unnecessary.

		$tvaHeaderData["rawheader"] = $ivsHeader;
		$tvaHeaderData["headersizerankformatted"] = $tviHeaderSizeRankFormatted;
		$tvaHeaderData["headersizerank"] = $tviHeaderSizeRank;
		$tvaHeaderData["headersize"] = $tviHeaderLength;

		return $tvaHeaderData;
	}
}
?>
