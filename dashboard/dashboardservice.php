<?php
@session_start();

class DashboardService {

	function getfrominternet($fvsDomainName) {
		error_log("Domain: ".$fvsDomainName." was obtained from internet. (dashboard)");

$tvsCountryRank = $tvaAlexaData["countryrank"];
$tvsGlobalRank = $tvaAlexaData["globalrank"];

$tvsCountryRankOrdinal = number_format((int)$tvsCountryRank).substr(date('jS', mktime(0,0,0,1,($a%10==0?9:($a%100>20?$a%10:$a%100)),2000)),-2);
$tvsGlobalRankOrdinal = $tvsGlobalRank.substr(date('jS', mktime(0,0,0,1,($a%10==0?9:($a%100>20?$a%10:$a%100)),2000)),-2);

$tvsDomainNameUc = ucfirst($fvsDomainName);

$reportText = "$tvsDomainNameUc has a global Alexa ranking of ".$tvsGlobalRankOrdinal." and is ranked ".$tvsCountryRankOrdinal.
" in $countryName. The global rank improved ".number_format(abs($rankDelta))." positions versus the previous 3 months.
 $domainUc has an estimated website worth of US$".number_format($rankvalue_estimate,2)." (based on the daily revenue 
potential of the website over a 12 month period). $domainUc possibly receives an estimated ".number_format($daily_traffic_estimate,0)." 
 unique visitors every day. The website server is using IP address $ip and is hosted in ".$details->city.", ".$details->region.", 
 ".$details->country.". This website's home page has ".$numLinks." out-going links.";

		$tvaDashboardData = array();
		$tvaDashboardData["rawtext"] = $tvsRawText;
		$tvaDashboardData["Dashboardrecordarray"] = $tvsDashboardRecordArray;
		$tvaDashboardData["Dashboardagerankformatted"] = $tviDashboardAgeRankFormatted;

		return $tvaDashboardData;
	}
}
?>
