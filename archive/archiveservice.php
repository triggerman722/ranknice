<?php
@session_start();

class ArchiveService {

	function getfrominternet($fvsDomainName) {
		error_log("Domain: ".$fvsDomainName." was obtained from internet. (archive)");
		$tvjArchive = json_decode(file_get_contents("https://web.archive.org/__wb/sparkline?url=$fvsDomainName&collection=web&output=json"));

		$tviMonthSum = 0;
		$tviMonthCount = 0;
		$tviMonthMax = 0;
		$tviMonthMin = 15;
		$tviFirstArchive = $tvjArchive->first_ts;
		$tviLastArchive = $tvjArchive->last_ts;

		$tvaYears = $tvjArchive->years;
		foreach($tvaYears as $tvaYear) {
			foreach($tvaYear as $tvaMonth) {
				$tviMonthSum += $tvaMonth;
				$tviMonthCount++;
				$tviMonthMax = max($tviMonthMax, $tvaMonth);
				$tviMonthMin = min($tviMonthMin, $tvaMonth);
			}
		}

		//http://netberry.co.uk/alexa-rank-explained.htm
		//monthly = round(104943144672*($tviGlobalRank**-1.008));
		//from above, I have monthly, so I need something reverse exponent -1.008 = 350000/630638. log and ln?
		//yahoo 528,929
		//google 630,638

		//there are 104943144672 sites, and #1 is 630,638. What is this site?  166407.9 = 104943144672 - (166407.9* YOURNUMBER)

		//TODO: become familiar with parabolic math. #2 could be 300K. If you have 270, you are probably #1B.

		$tviGoogleDivisor = 166407.9;
		$tviGoogleArchiveCount = 630638;

		$tviTotalWebsites = 104943144672;
		//$tviArchiveRank = ($tviTotalWebsites - ($tviGoogleDivisor * $tviMonthSum));
		$tviArchiveRank = ceil($tviGoogleArchiveCount*($tviMonthSum**-1.008));
		$tviArchiveRankFormatted = number_format($tviArchiveRank);

		//$tvjArchive->country

		//get the data:
		//https://web.archive.org/__wb/sparkline?url=$ivsDomainName&collection=web&output=json

		//how many times has this domain been archived?
		//how many muiltiple pulls days?
		//how does this site's archival count compare to the most archived site ever?
		//archival rate? this is the frequency of archival since inception (i.e. like points per game for a hockey player).
		//age of the site from the perspective of archive.org.
		//list of all past archives
		//archival versus alexa?

		$tviMonthSumFormatted = number_format($tviMonthSum);
		$tviMonthCountFormatted = number_format($tviMonthCount);
		$tviAverageDensityFormatted = number_format($tviMonthSum/$tviMonthCount);
		//max and min
		$tviMonthMaxFormatted = number_format($tviMonthMax);
		$tviMonthMinFormatted = number_format($tviMonthMin);

		$tviFirstArchiveFormatted = date_create_from_format("YmdHis", $tviFirstArchive)->format("l F n, Y G:i A");
		$tviLastArchiveFormatted = date_create_from_format("YmdHis", $tviLastArchive)->format("l F n, Y G:i A");

		$tvaArchiveData = array();
		$tvaArchiveData["firstarchiveformatted"] = $tviFirstArchiveFormatted;
		$tvaArchiveData["lastarchiveformatted"] = $tviLastArchiveFormatted;
		$tvaArchiveData["monthsumformatted"] = $tviMonthSumFormatted;
		$tvaArchiveData["monthcountformatted"] = $tviMonthCountFormatted;
		$tvaArchiveData["averagedensityformatted"] = $tviAverageDensityFormatted;
		$tvaArchiveData["monthmaxformatted"] = $tviMonthMaxFormatted;
		$tvaArchiveData["monthminformatted"] = $tviMonthMinFormatted;
		$tvaArchiveData["archiverankformatted"] = $tviArchiveRankFormatted;

		return $tvaArchiveData;
		//how does this compare to the most archived sites on the net?
	}
}
?>
